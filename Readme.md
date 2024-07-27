# Symfony Application Overview

This repository contains a Symfony application structured to adhere to best practices in software architecture, implementing various design patterns and principles. Below is an overview of the implemented patterns and the directory structure:

## Implemented Design Patterns and Architectural Principles

### Repository Pattern

The repository pattern is implemented to abstract the data access layer from the domain logic.

- **UserRepositoryInterface**: Defines methods to interact with the User entity.
- **UserRepository**: Concrete implementation using Doctrine for data persistence.

### Data Transfer Object (DTO)

Data Transfer Objects are used to transfer data between different layers of the application.

- **UserDTO**: Represents a data structure for transferring user-related information.

### Command Query Responsibility Segregation (CQRS)

CQRS separates commands (write operations) from queries (read operations).

- **CreateUserCommand**: Represents a command to create a new user.
- **CreateUserCommandHandler**: Handles the CreateUserCommand to persist a new user.

### Domain-Driven Design (DDD)

The application structure follows DDD principles to organize code around business domains.

- **Domain**: Contains domain logic and entities.
- **Application**: Implements use cases and application services.
- **Infrastructure**: Provides implementations for repositories, services, and external dependencies.

### Onion Architecture

The application architecture is based on the Onion Architecture pattern, emphasizing separation of concerns and dependency inversion.

- **Core (Domain)**: Contains the core business logic and domain entities.
- **Application Services**: Implements application-specific logic and use cases.
- **Infrastructure**: Handles external dependencies such as database access and third-party integrations.
- **Shared**: Contains shared interfaces and utilities used across different layers.

## Directory Structure

```
├── Products
│   ├── Application
│   │   ├── Command
│   │   │   ├── CreateProduct
│   │   │   │   ├── CreateProductCommand.php
│   │   │   │   └── CreateProductCommandHandler.php
│   │   │   └── CreateProductConsoleCommand.php
│   │   ├── DTO
│   │   │   └── ProductDTO.php
│   │   └── Query
│   │       ├── GetActiveProducts
│   │       │   ├── GetActiveProductsQuery.php
│   │       │   └── GetActiveProductsQueryHandler.php
│   │       └── GetProductById
│   │           ├── GetProductByIdQuery.php
│   │           └── GetProductByIdQueryHandler.php
│   ├── Domain
│   │   ├── Entity
│   │   │   └── Product.php
│   │   ├── Factory
│   │   │   └── ProductFactory.php
│   │   └── Repository
│   │       └── ProductRepositoryInterface.php
│   └── Infrastructure
│       ├── Database
│       │   └── ORM
│       │       └── Product.orm.xml
│       └── Repository
│           └── ProductRepository.php
├── Shared
│   ├── Application
│   │   ├── Command
│   │   │   ├── CommandBusInterface.php
│   │   │   ├── CommandHandlerInterface.php
│   │   │   └── CommandInterface.php
│   │   └── Query
│   │       ├── QueryBusInterface.php
│   │       ├── QueryHandlerInterface.php
│   │       └── QueryInterface.php
│   ├── Domain
│   │   └── Service
│   │       └── UlidService.php
│   └── Infrastructure
│       ├── Bus
│       │   ├── CommandBus.php
│       │   └── QueryBus.php
│       ├── Controller
│       │   ├── HealthCheckAction.php
│       │   ├── HomepageController.php
│       │   ├── PhpinfoController.php
│       │   └── ProductController.php
│       ├── Database
│       │   ├── Fixtures
│       │   │   └── ProductFixtures.php
│       │   └── Migrations
│       │       ├── Version20240706235206.php
│       │       ├── Version20240726082748.php
│       │       └── Version20240726165031.php
│       └── Kernel.php
└── Users
    ├── Application
    │   ├── Command
    │   │   ├── CreateUser
    │   │   │   ├── CreateUserCommand.php
    │   │   │   └── CreateUserCommandHandler.php
    │   │   ├── CreateUserConsoleCommand.php
    │   │   ├── EraseUserCredentials
    │   │   │   ├── EraseUserCredentialsCommand.php
    │   │   │   └── EraseUserCredentialsCommandHandler.php
    │   │   └── EraseUserCredentialsConsoleCommand.php
    │   ├── DTO
    │   │   └── UserDTO.php
    │   └── Query
    │       └── FindUserByEmail
    │           ├── FindUserByEmailQuery.php
    │           └── FindUserByEmailQueryHandler.php
    ├── Domain
    │   ├── Entity
    │   │   └── User.php
    │   ├── Factory
    │   │   └── UserFactory.php
    │   ├── Repository
    │   │   └── UserRepositoryInterface.php
    │   └── Service
    │       └── UserCredentialsService.php
    └── Infrastructure
        ├── Database
        │   └── ORM
        │       └── User.orm.xml
        └── Repository
            └── UserRepository.php
```










