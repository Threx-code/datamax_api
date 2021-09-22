# Datamax_API
This application is in 3 modules

================================ MODULE 1
=====================================================================================
It connects to https://anapioficeandfire.com/. API and serialized the results. You can pass a name parameter if you want to fetch only a specific book or call the end-point without passing any parameter. below are the two endpoints

End-point 1
http://localhost:8000/api/external-books/
This will return lists of books


End-point 2
http://localhost:8000/api/external-books?name=nameOfBook
This will return a specific book

================================ MODULE 2
=====================================================================================
A CRUD API

END-POINT VERBS 
Create => POST Request
Read => GET Request
Update => PUT Request
Delete => DELETE Request
Show => GET Request

END-POINTS
The CREATE AND READ end-point is 
http://localhost:8000/api/v1/books/

the UPDATE, DELETE AND SHOW end-point
http://localhost:8000/api/v1/books/1


================================ MODULE 3
=====================================================================================
A front-end view for reading, editing, updating and deleting books

N.B. you can comment the javaScript for updating and deleting if you do not wish to use javascript. The application will still work perfectly. It's just an added functionality that I feel could make the application user friendly

READ FEATURE GET Request
http://localhost:8000/

This will display books record 10 per request call. Click on the load more button to fetch the next 10 records


EDIT FEATURE GET REQUEST
http://localhost:8000/edit/1

This will display a single book that is editable within a form. You can edit each field as you wish.


UPDATE FEATURE PUT
http://localhost:8000/update/4

This will update the record of a specific book

DELETE FEATURE PUT
http://localhost:8000/delete_book/4

This will delete the record of a specific book