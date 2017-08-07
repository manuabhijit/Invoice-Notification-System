# Invoice-Notification-System
A php based invoice notification system

# How to Install:

    Requirments:
        1. Php
        2. MySQL
        3. Web Browser [Chrome prefered]

        Step 1: Use the database files in sample Database folder to generate Database
        also change the database cnnectivity authentication details in file db_connect.php
        Step 2[optional] : Run include sql commands to generate the sample Database
        Step 3: Copy the folder to the server and run index.php in web browser.


# How to Run:

    Step 1: [SignUp] Register 2 or more users at index.html

        1. Username : "user_one@gmail.com" ,  Password : "qwertyuiop"
        2. Username : "user_two@gmail.com" ,  Password : "qwertyuiop"
        3. Username : "user_three@gmail.com" , Password : "qwertyuiop"
        4. Username : "user_four@gmail.com" ,  Password : "qwertyuiop"

            [Login] Login a users at index.html and you will be moved to dashboard.php

        Summary :   data-validation is done by login_signup.js and data is send to login_check.php and signup.php
                    respectively for database checks of users existance and to make entry in case of signup.


    [About Dashboard]     This page [Dashboard] has 3 parts.
                        1. Recieved Invoices
                            1.1 Notifications you have not responded yet.
                                1.1.1 Take Accept or reject action and add a small message.
                            1.2 Notifications you have already responded.
                                1.2.1 Can View the message you wrote to the sender.

                        2. Create invoice form.
                            2.1 A form to fill up all informations for a invoice
                            2.2 Sender is the person already logged in.
                            2.3 Reciever should be register else will show a warning
                            2.4 A Sender can add  upto 5 items in the invoice.

                        3. Send Invoices
                            3.1 Shows up all the sent notifications.
                            3.2 Show accepted, rejected or pending as current invoice status.

    Step 2: [Create Invoice] Create Invoice fom the form given and send it to registered users (including yourself).
            Click on Send Invoice to send the invoice.
            Refesh the page to check your database.


    Step 3: Login to a different user (the one you have send the invoice.
            As you login You will see the notifications
            You can take action on the Recieved Invoices and also leave a message

    Step 4 : Dynamically Generate PDF Clicking on the Invoice ID.
