# Family Tree Problem

The code solution for the family tree problem.

## Test Files

Please add all the test files to /tests/inputFiles/ directory with file extension .txt before running the test.

## Usage

Run the following command in CLI interface from the root directory

```php
php tests/execute.php
```

## Sample Output
Following is a sample output for the current test files in the code.

```bash
Starting test with input file: 01-paternal-uncle.txt

Ish Vich Aras
NONE
PERSON_NOT_FOUND


Completed test with input file: 01-paternal-uncle.txt



Starting test with input file: 02-maternal-uncle.txt

Chit Ish Vich Aras
NONE
PERSON_NOT_FOUND


Completed test with input file: 02-maternal-uncle.txt



Starting test with input file: 03-paternal-aunt.txt

Satya
NONE
PERSON_NOT_FOUND


Completed test with input file: 03-paternal-aunt.txt



Starting test with input file: 04-maternal-aunt.txt

Tritha
NONE
PERSON_NOT_FOUND


Completed test with input file: 04-maternal-aunt.txt



Starting test with input file: 05-sister-in-law.txt

Tritha
Krpi
NONE
PERSON_NOT_FOUND


Completed test with input file: 05-sister-in-law.txt



Starting test with input file: 06-brother-in-law.txt

Vritha
Vyan
NONE
PERSON_NOT_FOUND


Completed test with input file: 06-brother-in-law.txt



Starting test with input file: 07-son.txt

Asva Vyas
Asva Vyas
NONE
PERSON_NOT_FOUND


Completed test with input file: 07-son.txt



Starting test with input file: 08-daughter.txt

Atya
Atya
Vila Chika
NONE
PERSON_NOT_FOUND


Completed test with input file: 08-daughter.txt



Starting test with input file: 09-siblings.txt

Chit Ish Vich Satya
NONE
Chika
Tritha Vritha
PERSON_NOT_FOUND


Completed test with input file: 09-siblings.txt



Starting test with input file: 10-add-child.txt

CHILD_ADDITION_FAILED
CHILD_ADDITION_SUCCEEDED
CHILD_ADDITION_SUCCEEDED
PERSON_NOT_FOUND


Completed test with input file: 10-add-child.txt
```


## Note
The test builds the initial family tree for each test file in the inputFiles directory. So each test file is treated as independent.