# Import-JSON
Import JSON file


Download, install and activate "twentynineteen" theme from repo.

Set in terminal 

cd <path of  "twentynineteen" theme>



---------------------------- Tasks 1 ---------------------------- 
-------------
Import Data
-------------

For import all datas run   ./test/myscript.sh


---------------------------- Tasks 2 ---------------------------- 
------------
Show Data
------------

Create new page and choose "Events List Template" http://prntscr.com/o9hem3

After saving, on front side you will see this http://prntscr.com/o9hf27


---------------------------- Tasks 3 ---------------------------- 
-------------
Export Data
------------

Accessed through a URL and sorted by timestamps

http://prntscr.com/o9hl1y

Need to set your host and select the current date or any other day for which you would like to see sorted data

http://localhost/wpclidemo.dev/wp-json/wp/v2/events?filter[meta_key]=time&filter[meta_compare]=%3E&filter[meta_value]=2019-07-01&filter[orderby]=meta_value&filter[order]=ASC&filter[posts_per_page]=100







