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

To Fix Error "Please provide a valid cache path"

```bash
cd storage/

mkdir -p framework/{sessions,views,cache}

chmod -R 775 framework
```

Clear Cache

```bash
php artisan optimize

php artisan cache:clear
```

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

### Retrieve Users(Requires Token)

This query retrieves a list of users with pagination.

```bash
query Users {
    users(limit: 5, page: 1) {
        data {
            id
            name
            email
            position
            salary
            role
            department
            date_of_birth
            nrc
            address
            phone
            gender
            skills
            emergency_contact
            emergency_contact_number
            joining_date
            system_status
        }
        total
        per_page
        current_page
        from
        to
        last_page
        has_more_pages
    }
}
```

-   Headers:
    Include the token in the request header:

```bash
Authorization: Bearer {token}
```

### Retrieve User by ID(Requires Token)

This query fetches detailed information for a single user by their ID.

```bash
query UserById {
    userById(id: 1) {
        id
        name
        email
        position
        salary
        role
        department
        date_of_birth
        nrc
        address
        phone
        gender
        skills
        emergency_contact
        emergency_contact_number
        joining_date
        system_status
    }
}
```

-   Headers:
    Include the token in the request header:

```bash
Authorization: Bearer {token}
```

### Create a New User(Requires Token)

This mutation allows you to create a new user with the provided details.

```bash
mutation CreateUser {
    createUser(
        name: "one"
        email: "one@gmail.com"
        password: "123321321"
        position: "staff"
        salary: "1231223"
        department: "HR"
        date_of_birth: "2001-12-12"
        nrc: "1/makata(N)123321"
        address: "No.60,Main Road"
        phone: "09300200100"
        gender: "male"
        skills: "language"
        emergency_contact: "mom"
        emergency_contact_number: "0192030404"
        joining_date: "2024-10-10"
        system_status: "active"
        role: "user"
    ) {
        id
        name
        email
        position
        salary
        role
        department
        date_of_birth
        nrc
        address
        phone
        gender
        skills
        emergency_contact
        emergency_contact_number
        joining_date
        system_status
    }
}
```

-   Headers:
    Include the token in the request header:

```bash
Authorization: Bearer {token}
```

### Update an Existing User(Requires Token)

This mutation updates an existing user's details, including their name, position, salary, and more.

```bash
mutation UpdateUser {
    updateUser(
        id: "2"
        name: "update name"
        email: "tee@gmail.com"
        password: "4321234568"
        position: "new update position"
        salary: "111223344"
        role: "admin"
        department: "new update departnment"
        address: "No.101,Baho Road"
        nrc: "1/makana(N)11223344"
        date_of_birth: "2000-11-11"
        phone: "09100200300"
        gender: "male"
        skills: "new update skill"
        emergency_contact: "Dad"
        emergency_contact_number: "09100200300"
        joining_date: "2024-11-12"
    ) {
        id
        name
        email
        position
        salary
        role
        department
        date_of_birth
        nrc
        address
        phone
        gender
        skills
        emergency_contact
        emergency_contact_number
        joining_date
        system_status
    }
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
