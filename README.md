## Menrva 🦉

Personal project done to validate my master 2. 🏫 This Laravel VueJS project is accessible on both web and mobile, with the aim of connecting notaries 👩🏼‍⚖️ and future aspirants to the profession.

## Project Status

The project is currently deployed as V1. Users are able to log in, edit their information, search and interact with each other through a like and playlist system.

## Project Screen Shot(s)

WIP

## Installation and Setup Instructions

Clone down this repository. You will need `node` and `npm` installed globally on your machine.  

Installation:

`composer install`  

Copy .env.example file to .env on the root folder, change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.

Generate a key:  

`php artisan key:generate`  

Load database table and seeds:

`php artisan migrate:fresh --seed`  

Run server:

`php artisan serve` 

Compile front part

`npm run dev`

To Visit App:

`localhost:8000` 

## Reflection

Being surrounded by people in the notary's profession on a daily basis, I am therefore directly exposed to their expectations and needs with regard to technology. At first I could understand that it was rather difficult for them to cohabit with technology because of the age of the profession and the codes it includes, you will not see any notary converting to 100% digital overnight as the constraints involved are enormous (e.g. digitalising archives dating back over a century).

Nevertheless, like any ageing profession, this one is being renewed. This renewal entails an almost inevitable cohabitation with new technologies.

My relations with aspiring notaries make me focus on the integration of the profession into the notary's office. This is why I will mention the specific needs of this new generation.

With the testimonies I have been able to gather, I was able to quickly put my finger on a major problem in the field: recruitment. As I said, the profession is ageing and is struggling to renew itself. Today it is the notaries who are looking for employees and not the other way round. Whether it is on Linkedin or on various Facebook groups, you can regularly come across posts from offices looking for a notary, notary clerk or even trainee notary. At first glance one could conclude that the profession suffers from too much demand for the number of offers, but not at all. On these same Facebook groups you can also find a lot of posts from students at the end of their studies looking for opportunities or even for work experience.

I therefore wondered if there was not a platform that could put notary offices and job seekers in touch with each other.

There is a platform that meets this need... However, this platform is unknown to jobseekers and is also not well known (which I understand when I see it). Whether it is visually or ergonomically, one understands very quickly that it is intended for the generation that is belligerent towards new technologies.

That is why I propose a solution allowing the transition of generation made to measure.
