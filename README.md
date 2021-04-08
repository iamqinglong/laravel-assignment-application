# Tussendoor - Laravel Assignment
---

This is a fictitious application in Laravel, used as an interview assignment.

## Description
---

This is a small code base with a very basic blog post module. The basic CRUD operations are implemented, like creating, updating and deleting posts. We've added the [Laravel-AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE) package for some basic styling.

Unfortunately, this codebase has some issues:

- There is almost no input validation
- Code is repeated throughout the controller and violates accepted design principles (DRY, encapsulation, delegation)
- In some blade views presentation is mixed with code
- Some builtin Laravel functionality is not utilized
- Slugs are not automatically created nor are they checked for duplicates

It's generally just not a very nice codebase, and we'd like to see it improved. 

## Assignment
---

Your job in this assignment is to take some time and improve the codebase. You are free to add, remove or change anything you see fit. For example, if you want to import other packages, rewrite parts or make changes to the database schema: go for it!

There's only one thing that we'd like to see you change: currently the post statuses are simple strings. We would like something that encapsulates the Post status, so it's more robust.

What we're mostly looking for is to see is what you chose to tackle and how you went about it. 

The aim is to spend approximately 2 hours on this assignment. If you didn't get to something in that time you'd still like to have tackled, feel free to add a readme file like this to your project with the next steps you would have done, given more time.

## Final remarks
---

- We do not require you to add more styling whatsoever. If you do not want to use AdminLTE and use basic HTML without styling, that's also fine. We care more about your PHP code than the styling.

- We did not include users and authentication on purpose. You are not required to implement any authentication/user system.

## Installation
---

### 1: Clone repository

Please clone this repository to your local machine. We would like you to make regular git commits while working on the project. So initialize a new, empty GIT repository and commit your changes to it. This way we can see your progress and way of thinking.

### 2: Install  and configure

Install the dependencies via `composer`. We've added migrations and seeders, so you can work with 'real' data.

### 3: Make the changes

Please commit frequently while working on this assignment, so we can see your progress and discuss it later. You do not have to push the repository it to an online GIT service like Github.

### 4: Time's up, pack up!

Please create a zip archive of the project including your GIT repository and send it to us. It's okay if you didn't get to something in time. Feel free to add a readme file to explain what you would have improved more.
