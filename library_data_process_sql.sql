alter table library_collection_inventory drop column ReportDate;
alter table library_collection_inventory drop column floatingitem;


select count(*) from library_collection_inventory where ItemLocation = 'cen';


select count(bibnum) from library_collection_inventory group by Title,author, isbn,publicationyear,publisher,subjects,itemtype;

--select repeated bibnum
select t.BibNum from 
(select BibNum,count(bibnum) countbibnum from library_collection_inventory group by bibnum) as t 
where countbibnum>1;

select t.BibNum from 
(select BibNum,count(bibnum) countbibnum from bookinventory group by bibnum) as t 
where countbibnum>1;

--useless
select * from library_collection_inventory where bibnum not in
(select t.bibnum from ((select max(itemlocation) onelocation, bibnum
from library_collection_inventory a group by a.bibnum)as t ));

--useful
CREATE INDEX bibnumindex
ON library_collection_inventory (bibnum);
--useful
CREATE INDEX itemlocationindex
ON library_collection_inventory (itemlocation);
--useful
CREATE table bookinventory
(select * from library_collection_inventory as a
where not exists(select 1 from library_collection_inventory 
where a.BibNum = BibNum and (a.itemlocation<ItemLocation or a.itemcollection<ItemCollection)));


delete from bookinventory where BibNum = 200832;
delete from bookinventory where BibNum = 1857221;
delete from bookinventory where BibNum = 2414575;
delete from bookinventory where BibNum = 2567576;




-------oracle
insert into BOOK 
(BIBNUM,TITLE, AUTHOR, ISBN, SUBJECT,
PUBLICATIONYEAR,PUBLISHER, BOOKCATEGORY,ITEMCOUNT) 
select "BibNum","Title","Author",
ISBN,"Subject","PublicationYear", "Publisher","ItemCollection","ItemCount"
from "bookinventory";


insert into BOOK 
(BIBNUM,TITLE, AUTHOR, ISBN, SUBJECT,
PUBLICATIONYEAR,PUBLISHER, BOOKCATEGORYCODE,ITEMCOUNT) 
select "BibNum","Title","Author",
ISBN,"Subject","PublicationYear", "Publisher","ItemCollection","ItemCount"
from "bookinventory";


alter table book add bookcategory VARCHAR2(1024);

insert into BOOK (bookcategory) select "category111"."Description"
from "category111",BOOK 
where BOOK.BOOKCATEGORYCODE = "category111"."Code"; 

select * from book NATURAL JOIN "category111"
on BOOK.BOOKCATEGORYCODE = "category111"."Code";


update BOOK
set BOOK.BOOKCATEGORY = "category111"."Description"
from BOOK , "category111"
where BOOK.BOOKCATEGORYCODE = "category111"."Code"; 

CREATE INDEX codeindex ON "category111" ("Code");
CREATE INDEX desindex ON "category111" ("Description");
CREATE INDEX catecodeindex ON book (BOOKCATEGORYCODE);

create table bookwithcate as
select * from book NATURAL JOIN
(select DISTINCT "category111"."Description","category111"."Code" from BOOK , "category111" where BOOK.BOOKCATEGORYCODE = "category111"."Code") abc
where abc."Code" = BOOK.BOOKCATEGORYCODE;




alter table bookwithcate drop column "Code";
alter table bookwithcate drop column BOOKCATEGORYCODE;
alter table bookwithcate drop column BOOKCATEGORY;

----checkout table
CREATE INDEX itemtypeindex
ON bookinventory (itemtype);

CREATE INDEX bibnumindex
ON bookinventory (bibnum);

delete from checkouts_by_title_data_lens_2016
where checkouts_by_title_data_lens_2016.ItemType 
 not in (SELECT DISTINCT ItemType from bookinventory);


delete from checkouts_by_title_data_lens_2016
where checkouts_by_title_data_lens_2016.CallNumber 
 like 'CD%' ;

delete from checkouts_by_title_data_lens_2016
where checkouts_by_title_data_lens_2016.CallNumber 
 like 'DVD%' ;

delete from checkouts_by_title_data_lens_2016
where checkouts_by_title_data_lens_2016.Collection='nadvd' or 
checkouts_by_title_data_lens_2016.Collection='nabocd';

delete from checkouts_by_title_data_lens_2016
where checkouts_by_title_data_lens_2016.bibnumber 
 not in (SELECT DISTINCT BibNum from bookinventory);

 6386000行-2016年checkout


3876000行-2016年checkout

---delect from collection，not finished
CREATE INDEX icindex
ON bookinventory (ItemCollection);

delete from checkouts_by_title_data_lens_2016
where checkouts_by_title_data_lens_2016.collection 
 not in (SELECT DISTINCT ItemCollection from bookinventory);

 3850000行--year 2016 checkout

 --add rownum
create table checkoutrownum_2016(
SELECT
@row := @row + 1 as rownum,
t.*
FROM checkouts_by_title_data_lens_2016 t, (SELECT @row := 0) r);


delete from checkoutrownum_2016
where rownum%2=0;


delete from checkoutrownum_2016
where rownum%3=0;

--checkoutrownum_2016_rest1284000


delete from checkoutrownum_2016
where rownum%5=0;

delete from checkoutrownum_2016
where rownum%7=0;

--checkoutrownum_2016_rest880000

delete from checkoutrownum_2016
where rownum%11=0;

delete from checkoutrownum_2016
where rownum%13=0;

delete from checkoutrownum_2016
where rownum%17=0;

delete from checkoutrownum_2016
where rownum%19=0;

delete from checkoutrownum_2016
where rownum<500000;

--checkoutrownum_2016_ rest 573000


--checkoutrownum_2016rest 1030000 
--bookwithcate rest 73000 

--test to_char
SELECT to_char(to_timestamp(m."CheckoutDateTime",'mm/dd/yyyy hh:mi:ss AM')) FROM "checkout" m;
--right
update "checkout" set "CheckoutDateTime" = to_timestamp("CheckoutDateTime",'mm/dd/yyyy hh:mi:ss AM');



update "checkout" set "CheckoutDateTime" = to_timestamp("CheckoutDateTime",'mm/dd/yyyy hh:mi:ss AM');
ALTER TABLE "checkout" MODIFY "CheckoutDateTime" TIMESTAMP(9);

alter table "checkout" add "CheckoutDateTimeMid" TIMESTAMP(6);
update "checkout" set "CheckoutDateTimeMid" = "CheckoutDateTime";

alter table "checkout" drop column "CheckoutDateTimeMid";


insert into CHECKOUTRECORD 
(BIBNUM,BORROWDATETIME) 
select "BibNumber","CheckoutDateTimeMid"
from "checkout";

alter table CHECKOUTRECORD drop constraint SYS_C00555886;
alter table CHECKOUTRECORD drop constraint SYS_C00555885;
--alter table CHECKOUTRECORD drop constraint SYS_C00596313;


SELECT   *   from   user_cons_columns;

alter table CHECKOUTRECORD add constraint pk_bibnum_borrowdatetime primary key(BibNum, BorrowDatetime); 

--delete repeated data
select BIBNUM,BORROWDATETIME from CHECKOUTRECORD group by BIBNUM,BORROWDATETIME having count(*) > 1


