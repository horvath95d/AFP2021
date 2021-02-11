# AFP2021

## Database
  1. User: 
        - userid(primary key),
        - username(unique),
        - password,
        - email(unique),      
        - registerdate,
        - statusid
  2. UserLogin:
        - id(primary key),
        - userid(foreign key),
        - timedate,
        - ipaddress,
        - platform
  3. Messages:
        - id(primary key),
        - userid(foreign key),
        - text,
        - files,
        - timedate

## Requests
  1. GET/LOGIN  
    params:  
      - username/email  
      - password  
    response: {user: {userid, username, password, email, registerdate, statusid}} 
  2. GET/MESSAGES  
    params:
      - from
      - to  
    response: {messages: {id, userid, text, files, timedate}}   
    //Example: from: 1(Newest Message/File), to: 5
  3. POST/REGISTER  
    params:
      - username
      - email
      - password  
     response: {true/false} 
  4. POST/STATUSCHANGE  
    params:
      - userid
      - statusid  
    response: {}
  5. POST/SENDMESSAGE  
    params:
      - userid
      - text  
    response: {true/false}
  6. POST/SENDFILE  
    params:
      - userid
      - files  
    response: {true/false}
