create table test.guest_book
(
    id_guest    int auto_increment
        primary key,
    ip_address  varchar(15)  null,
    user_agent  varchar(255) null,
    view_date   datetime     null,
    page_url    text         null,
    views_count int          null,
    constraint ip_address unique (ip_address),
    constraint user_agent unique (user_agent)
);