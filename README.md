# NuxGame Test Task (by Vitalii Hava)

# Description
- Add step-by-step instructions for running the developed application in the README
- Set up application configurations so that the application can be launched without edits/adjustments by the tester use sqlite for the database (if you want another database, for example, mysql or postgresql, then first prepare a docker-compose.yaml file with the appropriate services)
- For cache, use file/db storage format (if you want memcached or redis, then pre-prepare docker-compose.yaml file with corresponding services)
- For queues, use sync mode (if you want rabbitmq or redis, then pre-prepare the docker-compose.yaml file with the corresponding services)
- Do not add unnecessary code, adhere to the YAGNI principle
- Do not complicate the code, adhere to the KISS principle

1) On the main page, you need to display a registration form with the following fields: Username, Phonenumber and the Register button. After the user has filled in the fields and clicked the Register button, the following happens: The user receives a generated unique link to a special page (page A), access to which will be available via a unique link for 7 days. After the time has expired, the link becomes invalid.
2) Page A functionality:
   - Ability to generate a new unique link
   - Ability to deactivate this unique link
   - Imfeelinglucky button
   - History button
   - When clicking on the "Imfeelinglucky" button, the user is shown:
   - Random number from 1 to 1000. Win / Lose result. Amount of winnings (0 if loss)
   - If the random number is even - display the Win result to the user. Otherwise, the Lose result.
   - Win amount. If the random number is over 900, the winning amount should be 70% of the random number. If the random number is over 600, the winning amount should be 50% of the random number. If the random number is over 300, the winning amount should be 30% of the random number. If the random number is less than or equal to 300, the winning amount should be 10% of the random number.
   - When clicking on the "History" button, the user is shown: Information about the last 3 results of clicking on the "Imfeelinglucky" button

## 🚀 Installation

1. Clone the project from the repository:

```bash
git clone git@github.com:den01101/nuxgame.git
```

2. Start and build containers
```bash
make start
```

3. Open http://localhost/
