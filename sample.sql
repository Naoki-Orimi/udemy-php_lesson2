-- 

create table categories(
    id integer primary key,
    title text
);

insert into categories (id, title) values (1, 'Programming');

select * from categories;

update categories set title = 'PG' where id = 1;

delete from categories where id = 1;
