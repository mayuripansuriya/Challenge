#/bin/bash

echo "Tested bellow queries on postgres version 12.0"

echo "you can change the database name and use your username and password to access the database"

echo "=========================================================================="

echo "1. Create database"
psql postgres -U postgres -c "CREATE DATABASE my_test2 WITH ENCODING 'UTF8' TEMPLATE template0";
echo "====================DB Created============================================"

echo "2. Import SB schema"
psql my_test -U postgres < db.bak;
echo "====================Schema imported======================================="

echo "3. Importing test data for table authors"
psql -U postgres -c "copy authors(id, name, country) from '/authors.csv' CSV";
echo "====================Data imported for authors============================="

echo "4. Importing test data for table Books"
psql -U postgres -c "copy books(id, name,author,pages)) from '/books.csv' CSV";
echo "====================Data imported for Books==============================="

echo "5. Find author by name 'Leo'"
psql -U postgres - c "SELECT * FROM authors WHERE name ILIKE 'leo%'";
echo "====================Query 1 execution completed========================="

echo "6. Find books of author 'Fitzgerald'"
psql -U postgres - c "SELECT * FROM books WHERE author ILIKE '%Fitzgerald%'";
echo "====================Query 2 execution completed========================="

echo "6. Find authors without books"
psql -U postgres - c "SELECT * FROM authors LEFT JOIN books ON authors.name = books.author WHERE books.author is NULL";
echo "====================Query 3 execution completed========================="

echo "7. Count books per country"
psql -U postgres - c "SELECT COUNT(books.author), authors.country FROM authors LEFT JOIN books ON authors.name = books.author GROUP BY authors.country";
echo "====================Query 4 execution completed========================="

echo "8. Count average book length (in pages) per author"
psql -U postgres - c "SELECT AVG(books.pages), authors.name FROM authors LEFT JOIN books ON authors.name = books.author GROUP BY authors.name";
echo "====================Query 5 execution completed========================="
