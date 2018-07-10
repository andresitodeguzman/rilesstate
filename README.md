# RailTime Progressive Web App by RilesState
Hackatren 2018 :flushed: :flushed: :flushed:

Members:

* Andresito de Guzman

    De La Salle University - Dasmariñas\
    College of Science and Computer Studies\
    BS Biology Major in Human Biology (on-going)\
    andresitomyemail@gmail.com

* Stephen John Raymundo

    De La Salle University - Dasmariñas\
    College of Science and Computer Studies\
    BS Information Technology (on-going)\
    bayan.mahal@gmail.com

* Tristan Jules Rosales

    Asiagate Networks, Inc.\
    Analyst Programmer\
    tristanrosales0@gmail.com

## Setup Reminders
- Rename the file `_system/config.temp.php` as `_system/config.php` and place all the necessary env values.
- Install the composer modules; these are necessary for the websocket/realtime api to function
- Import the SQL file on a MySQL/MariaDB server.

## How to Run Server
- Run MySQL/MariaDB Server in the port indicated on the config file.
- Run Apache HTTP server as usual
- Invoke `php rt-serve.php` to run the websocket server