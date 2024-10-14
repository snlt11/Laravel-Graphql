# Laravel Application with GraphQL, Authentication, and CRUD Operations

## About the Project

This Laravel application demonstrates the integration of GraphQL with various features, including authentication, CRUD operations, and data import/export. The project utilizes Laravel Passport for authentication and Rebing/GraphQL for GraphQL support.

## Key Features

1. GraphQL Support: The application uses Rebing/GraphQL to provide GraphQL endpoints for CRUD operations, import/export functionality, and authentication.

2. Authentication: Laravel Passport is used for handling user authentication. The application includes GraphQL mutations for logging in and out, as well as checking user permissions.

3. CRUD Operations: The application provides GraphQL mutations for creating, reading, updating, and deleting records in the database. The mutations are implemented using Laravel's Eloquent ORM for efficient data retrieval.

4. Data Import/Export: The application includes GraphQL mutations for importing and exporting data in CSV format. The import process uses Laravel's Eloquent ORM to validate and save the imported data, while the export process generates a CSV file containing the desired data.

5. Error Handling: The application includes GraphQL error handling to provide meaningful error messages to the client. It utilizes Laravel's exception handling and GraphQL error formatting to ensure that errors are properly returned to the client.

## Getting Started

Clone the repository:

```bash
git clone https://github.com/snlt11/Laravel-Graphql
```

Install dependencies:

```bash
composer install
```

Copy .env.example file to .env on the root folder:

```bash
cp .env.example .env
```

Generate Key

```bash
php artisan key:generate
```

Configure the database:
Update the `.env` file with your database credentials and run the database migrations:

```bash
php artisan migrate
```

Generate a personal access client for authentication:

```bash
php artisan passport:client --personal
```

Make sure to note the client ID and secret, as you will need them for authentication.

Start the development server:

```bash
php artisan serve
```

## GraphQL Schema

The application includes a GraphQL schema file (`graphql/schema.graphql`) that defines the available queries, mutations, and types for the API. You can customize the schema to fit your specific requirements.

## Testing

To test the application, you can use a GraphQL client like GraphQL Playground or Postman. Make sure to include the necessary authentication headers in your requests.

## Contributing

Contributions are welcome! If you find any bugs or have suggestions for improvements, please feel free to open an issue or submit a pull request.

## End Point For Register, Login , Logout and Employee CRUD

### Register a New User

To register a new user, use the following GraphQL mutation:

```bash
mutation Register {
  register(name: "one", email: "one@gmail.com", password: "123321123") {
    message
    token
    status_code
  }
}
```

### Login

To log in and retrieve a token, use the following mutation:

```bash
mutation Login {
  login(email: "super@admin.com", password: "supersecret") {
    message
    token
    status_code
  }
}
```

### Logout(Requires Token)

To log out, the user must be authenticated by passing a token in the request headers:

```bash
mutation Logout {
  logout
}
```

-   Headers:
    Include the token in the request header:

```bash
Authorization: Bearer {token}
```

### Delete User (Requires Token)

To delete a user, you need to be authenticated and provide the user ID:

```bash
mutation DeleteUser {
  deleteUser(id: "4")
}
```

-   Headers:
    Include the token in the request header:

```bash
Authorization: Bearer {token}
```
