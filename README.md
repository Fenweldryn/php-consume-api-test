# PHP CHALLENGE
Develop an application to consume the provided API and complete the stories.

## How to run this project
docker is required to run this project.

if you have docker installed, run:
```
docker-compose up
```
the app will be available at:
```
http://localhost:8080/events
```

## Stack
This project uses VueJS for the frontend and php for the backend to consume the provided API. This project was conteinerized using docker.

## User Stories
### As a User, I want to see a list of all events
I know I will be done when:
- I can see all events on a list screen

### As a User, I want to be able to add an event to my Calendars
I know I will be done when:
- I can see my event listed on the list screen with fields
- I can add Event Title, Description, Start Date, End Date

### As a User, I want to be able to see the details of an event
I know I will be done when:
- I can see the details of an event on a detail screen.
- The detail screen can be reached via a “View details” link present along side every event on the list screen
