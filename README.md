
## Setup Development Environment
If this is the first time you're attempting to run this project in your local environment, please run the following command:
```bash
make dev
```
This command will automatically initiate docker-compose and execute the necessary commands to install PHP packages, migrate the database, and create dummy data, etc.

After the command has finished executing, access your [localhost](http://localhost/) to verify that the application has started successfully.

## Import and Test the Book Search API
You can test the API by executing or importing the following cURL command to Postman.
```
curl --location 'http://127.0.0.1/api/v1/search/book?q=keyword'
```
Please change **keyword** in the url to your desired search term.
## Run Tests
To execute unit tests, please run the following command:

```bash
make test
```
