--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.4
-- Dumped by pg_dump version 9.6.4

-- Started on 2017-09-24 05:13:08

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2129 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- TOC entry 478 (class 1247 OID 16396)
-- Name: gendertype; Type: TYPE; Schema: public; Owner: user
--

CREATE TYPE gendertype AS ENUM (
    'male',
    'female'
);


ALTER TYPE gendertype OWNER TO "user";

--
-- TOC entry 481 (class 1247 OID 16402)
-- Name: localitytype; Type: TYPE; Schema: public; Owner: user
--

CREATE TYPE localitytype AS ENUM (
    'resident',
    'nonresident'
);


ALTER TYPE localitytype OWNER TO "user";

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 185 (class 1259 OID 16407)
-- Name: student; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE student (
    name character varying(40),
    surname character varying(40),
    gender gendertype,
    groupnumber character varying(5),
    e_mail character varying(40),
    score smallint,
    dob date,
    locality localitytype,
    id bigint,
    hash character varying(20)
);


ALTER TABLE student OWNER TO "user";

--
-- TOC entry 2122 (class 0 OID 16407)
-- Dependencies: 185
-- Data for Name: student; Type: TABLE DATA; Schema: public; Owner: user
--

COPY student (name, surname, gender, groupnumber, e_mail, score, dob, locality, id, hash) FROM stdin;
Юля	Бондаренко	female	ИЯ-15	julb@bk.ru	250	1989-10-10	nonresident	1	\N
Алексей	Козлов	male	ФИ-34	zlob@google.ru	200	1982-10-10	nonresident	2	\N
Сергей	Семенов	male	13-ф	sema@mail.ru	111	1975-02-27	resident	3	\N
Мария	Макарова	female	15-фи	mackarka@nm.ru	128	1994-11-14	resident	4	6ZHc9sTQ/QWjqVddfSf6
Кирилл	Коростяков	male	фм-10	kiruha@yahoo.com	218	1991-06-09	nonresident	5	lTyLUp2WSvLGsOAJah1P
Юля	Конева	female	п-11	lesbi@outlook.com	179	1995-06-09	resident	6	QEoAp9EhEu3sD5r1PSp0
Александр	Олейник	male	фп-11	ibotan@me.com	212	1993-05-13	nonresident	7	tliAKQCmZ5mlnxy9U8G2
Иван	Филиппов	male	фс-12	connec@ya.ru	192	1985-08-09	resident	8	xBRNUdzX1ipfGtojKKnD
Федор	Конюхов	male	иф-4	horse@krovatka.ru	62	1972-10-20	resident	9	aE2Z+r8O+Qg7eku2hNVS
Алина	Рукосуева	female	ия-14	put@hand.com	114	1986-02-15	resident	10	/kUtGVTy9pGKll/mvLPR
Кира	Онипко	female	фл-10	onop@ko.com	126	1987-10-03	resident	19	ULZZ9UTCzakof6CM3IuC
Андрей	Гореликов	male	фд-14	afterfire@ya.ru	191	1987-07-19	nonresident	20	e/MZrVD4Y7xRIApZHY8N
Влада	Заярная	female	фп-04	crazy@bitch.com	119	1987-04-23	nonresident	21	JHeT8towxkNKnZPyfvgw
Алексей	Корчак	male	фд-11	golem@mail.ru	141	1987-09-10	resident	11	e6TwV+Q4eGaDpH2oMyHt
Наталья	Романовская	female	фн-3	addictedwhore@mail.com	73	1986-07-26	nonresident	22	wWXQqXo57bt33Z/06K4m
Анастасия	Фудченко	female	фп-06	letsbe@lgbt.com	192	1986-08-25	resident	23	1VXxAdV/oDiR9iBhBlK+
Мария	Голикова	female	фп-06	nudy@yahoo.com	152	1989-07-27	nonresident	24	y9oWChWesxu6A0mcR+/q
Роман	Кузнецов	male	фд-14	smith@rambler.ru	164	1984-08-22	resident	25	DQp2pexzw7g9hZxObtl4
Полина	Мейхер	female	ия-12	halfina@bk.ru	188	1990-01-24	resident	26	kwGY5P/HWZI8oEuO+Qjc
Мария	Сапарова	female	фп-04	uhonogaya@mail.ru	186	1994-04-26	resident	27	n6CnC2DdsJaOSqU42R3u
Екатерина	Кецкало	female	фп-04	klecka@ya.ru	135	1986-10-26	nonresident	28	SKUQ4qDHPLcCX9XUdSYj
Андрей	Золотухин	male	фд-14	golden@krovatka.ru	187	1989-12-23	nonresident	29	o9HS50IkXQ2e0WQOl3lM
Александр	Сталоверов	male	фп-04	boilsteel@ya.com	167	1978-10-05	resident	30	lXUKdB8qlkFBEcGnLC7X
Семен	Шерстнев	male	фд-14	fur@nm.ru	183	1989-10-07	resident	31	4JmjfdLV2v/eqYWUCgu4
Николай	Чепурных	male	ИЯ-15	alterego@mail.ru	249	1991-07-22	nonresident	32	Ur4LLttYOpAC95eA4nJD
Григорий	Волохов	male	фп-06	n@soulmates.com	228	1984-10-04	nonresident	33	U33M6x8NE8w6E+mX5m93
Даша	Крапоткина	female	ия-12	daha@spb.ru	116	1997-06-20	nonresident	12	HQBrWiPomCmm3r95xX3L
Владимир	Епифанцев	male	пи-0	epiph@nm.ru	132	1971-09-08	resident	13	yCfOhUtgxSuoO39/JIgM
Сергей	Пахомов	male	фк-2	pahom@yandex.ru	149	1966-11-06	resident	14	LwqFXSuAijS6h6t/5HWc
Владимир	Сорокин	male	фк-2	govno@bk.ru	209	1965-08-07	resident	15	pKXoxGQxE2xMgp0dlyGs
Виктор	Пелевин	male	фл-10	vp@vip.com	42	1968-11-22	nonresident	16	LSehhI6AIMTSUkT31K00
Елена	Беркова	female	фп-05	whore@hotbox.com	250	1979-03-19	resident	17	0hiXvGBtW5iWmay0JqtI
Оксана	Ганжа	female	фа-05	boshki@tor.org	106	1972-10-20	resident	18	AwvEBS5PlSMoAUV9iZbS
\.


-- Completed on 2017-09-24 05:13:09

--
-- PostgreSQL database dump complete
--

