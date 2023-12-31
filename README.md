# Finizens' FullStack Challenge

## Jordi:

Hi! First of all, thank you very much for the opportunity. It has been a challenging and fun test!

TL;DR
You can run the app by running `bash setup.sh`. Tech stack used is Symfony 6.3 as backend server, NextJS 13 as frontend and MySQL 8.0 as database.
You can find additional resources about the process [here](https://jordialbert.notion.site/Resources-15ad9de3daa84f4581d3ba397ecacf42?pvs=4). If you encounter any problem,
please contact me at jordiialb14@gmail.com and we will find a solution to it. Thank you!

### Instructions to run the app
To run the application, it should be enough by running the `setup.sh` bash script in the root directory of this project.
Make sure no applications or services are running on ports 8080, 3306 and 3000 since these are ports used for the services. Consider changing them
in the docker-compose file.

It should work straight away, but maybe some .env.local environment files have to be created manually. You can use the exact same values set in the .env files. I have done this
to speed up the process and make it easier.

```bash
bash setup.sh
```

### What has been done?
From the list of features of the challenge, all of them are completed except the `buy_post.feature` and the `sell_post.feature`, but the `complete_post.feature` is implemented.
Orders and Allocations can be added from the database itself :D.

The tech stack used is:
- Symfony 6.3 for the server
- NextJS 13 for the frontend
- MySQL 8.0 as database

From my understanding of the challenge, I have brought up the project in the following way:
- A user has a list of Portfolios, which can be 0 or more
- Each Portfolio may have 0 or more Allocations
- Each Allocation is associated with *just one* Portfolio
- Each Portfolio may have 0 or more Orders
- Orders are associated with a Portfolio and Allocation

Based on that, I created a database schema (see image from resource) from which start to work on my backend code by working on defining my Domain.

Afterwards creating the basic structure and configurations, I started implementing features at the backend and frontend at the same time. You can find some
mockups in the resources link.

NOTE: [Resources](https://jordialbert.notion.site/Resources-15ad9de3daa84f4581d3ba397ecacf42?pvs=4)

### Conclusions
That's a brief summary of how to run the application, what has been done and how it has been done. Please contact me if any problem arises at jordiialb14@gmail.com.
Thank you for the opportunity, hopefully we can have a discussion about it!

Jordi Albert

---

## Instructions

  - Feel free to use the framework, persistence system and third party library you like.
   As well other tooling.
   
  - You will need a GIT client to clone this repository. Once you finish
  create a patch of your work and send it to us. 
    - https://thoughtbot.com/blog/send-a-patch-to-someone-using-git-format-patch
    
  - You will find the required scenarios on the `features` folder of the project. 
  These are written in Gherkin language, you can use they as acceptance tests.
  
  - Whenever a system **PUT** a portfolio, every related data (allocations and orders)
    will be deleted.


## Backend

As a robo-advisor in Finizens we manage client's investment portfolios. 
In order to do this, a Customer contracts new portfolios and will trade allocations
on these portfolios.

The system will create a portfolio with its allocations.
In order to operate with the portfolio, it will create buy and sell
allocations' orders. Whenever an order is created, it will be completed on a undefined time. 

New allocations can be bought, even if they are present or not on the portfolio.

Allocations in the portfolio can be sold, if they not exceed the shares of it.
If an allocation hits 0 shares must be removed from the portfolio.

### Let's see the following scenario

The system creates a portfolio with two allocations: 
```
{
  "id": 1,
  "allocations": [
    {
      "id": 1,
      "shares": 3
    },
    {
      "id": 2,
      "shares": 4
    }
  ]
}
```

Then creates a buy order for a new allocation:
```
{
  "id": 1,
  "portfolio": 1,
  "allocation": 3,
  "shares": 3,
  "type": "buy"
}
```

So, now the allocation still is not part of the portfolio **until the order is completed**.
Once completed the portfolio should be like:
```
{
  "id": 1,
  "allocations": [
    {
      "id": 1,
      "shares": 3
    },
    {
      "id": 2,
      "shares": 4
    },
    {
      "id": 3,
      "shares": 3
    },
  ]
}
```

## Frontend

Create a view to operate the portfolio. It must show the portfolio, its allocations
and the current portfolio's non completed orders.

In order to keep the simplicity we can only create total sell orders of an allocation,
which means that all the shares will be sold.

Orders must be completed manually selecting them from a list. 

When the order is completed, the portfolio must be refreshed to update the information.

In case you'd like to start with the frontend or don't have enough time for completing the backend, you still can focus on the frontend with a simulated API we set up for this challenge:
* Install it running `make install` from your project's root directory, it should install all the required node dependencies.
* Run the mocked server with `make start`
* Check it running at http://localhost:3000
