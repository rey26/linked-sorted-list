# Linked sorted list

This repository implements linked sorted list of simple entity by its value. It is meant to demonstrate my ability to implement best possible PHP 8.1 practices.

## Installation

1. `docker-compose up -d --build` inside main directory

## Usage

* Create Node entity using NodeFactory, Node value can be either string or integer.
* All nodes in linked list should have either all values of type string or integer.
* Handle LinkedList of Node elements in LinkedListService and use its methods.
* Always set LinkedList before doing anything else.

## Testing

1. run `php bin/phpunit` inside php container (`docker-compose exec php /bin/bash`)
