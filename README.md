# ANANTA Technical Test
ANANTA would like to introduce a new custom ring product, the so-called Setting, where customers can choose their own diamond when purchasing a ring. ANANTA customers include local Thais and foreigners; as a result, the feature must support localization.

As a software engineer, you are tasked to add a new custom WordPress plugin `ananta-custom-diamond` to enable customers to pick a custom diamond when choosing a ring as the setting. The requirements for this plugin are as follows:  
- Back-end tasks:
  - Design database tables to store diamonds given by a supplier API (5 points)
    - API endpoint: https://anantajewelry.com/pub/tech-test/mock-diamonds.json
    - Diamond data model description: see `diamonds.md`
  - Create a backend process to pull diamonds and save them to the database. (5 points)
- Front-end tasks
  - Add a UI component on the ring products to display the list of diamonds (10 points)
  - Display the final price upon the diamond selection (5 points)
  - Include the diamond selection into the shopping cart (5 points)
  - Upon checkout, the selected diamonds shall be linked to the WooCommerce order (5 points)
  - Develop a Gutenberg block to display the random of 6 available diamonds and add the block to the Sample Page (10 points)
  - **Only the front-end solution written by Vanilla JS, Vue.js, and React is accepted. Submissions in jQuery or other frameworks will be disqualified immediately.**
- Internationalization support by the plugin (2 points)
- Technical documentation of the plugin (3 points)
- The codebase reflects the understanding of WordPress coding best practices (10 points)
- **Bonus: other features can be added to the test solution to demonstrate your creativity (15 points).**

In addition to the business requirements, ANANTA wants to migrate its website's traditional virtual machine server to container technology with the DevOps CI/CD process. To achieve this goal, the following tasks shall be fulfilled:
- Complete the Dockerfile to containerize WordPress by using the `nginx` official image (https://hub.docker.com/_/nginx) and configuring according to the given architecture diagram (10 points)
- Create a CI/CD pipeline for GitHub Actions to build the container and push to a Docker registry (10 points)
  - The Docker registry can be a fictitious one to simplify the setup.

## Test Package
The test package comprises the following resources:
- Architecture diagram
- Wireframe for the product detail page
- Wireframe for the Gutenberg diamond block
- WordPress files
- Database backup
- Empty Docker file 
- Empty GitHub workflow file.

## Submission
Push your solution to your own GitHub repository and grant access to account: `anantajewelry-it`

## Environment Setup
- Clone the code on this GitHub repository
- Restore the database from the dump file
- Configure WordPress for your local development
  - Default Url: http://anantatechtest.localhost/
  - Default WP user:  
    - Username: admin  
    - Password: admin
  - Database connection:
    - Host: localhost
    - User: root
    - Password: root

## Research guideline
- This is an open-book technical test. You can research individually over the internet, AI, book, or ask experts. Please note that your solution will be probed or asked to be enhanced by live coding during the interview.
- Open-source libraries can be used if tools are not specifically noted in a given task.

## Disclaimers
This test and all of ANANTA Jewelry (the company)'s related resources mentioned in this package are confidential and allowed only the authorized candidate to access.  

Distribution without the formal permission from the company is prohibited by the copyright law. ANANTA Jewelry reserves the right to pursue legal action for any kind of prohibitions.  

All materials, code, and other content submitted as part of the technical assessment process will become the property of the company. By submitting your work, you agree that the company retains full rights to use, modify, reproduce, or distribute the submission for any purpose, without restriction or compensation.