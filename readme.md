This program in intended to make the regular crud operations in a non 
datasource dependent pattern. it will read all the fields present in the xml/xslt and transform them into a html from to collect user input
it also has a seperate section where validations can be added to each/multiple
field(s).

as of now the package does not include any styling and has only limited custom_functions.

the plan is to have 2 sets of custom functions and 1main function. 
1. per processing functions(validations/checks/object definations)
2. processing function (main funciton which sends the validated data to a datasource) 3
3. post processing functions (additional actions to take after processing the user entered data)

