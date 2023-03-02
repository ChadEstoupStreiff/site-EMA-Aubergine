# Site WEB EMA Aubergine
EMA Aubergines community website is the website for referencing all usefull ressources for association life.  

## Important links
- [CDC](https://docs.google.com/document/d/1D_Cwk_JPBvU4kycO7Sg9CPh1gqrGHQWg/edit?usp=sharing&ouid=112875743801870679130&rtpof=true&sd=true)  
- [Git](https://github.com/ChadEstoupStreiff/site-EMA-Aubergine)  

## Equipe
- [Chad Estoup--Streiff](https://github.com/ChadEstoupStreiff)  
> Lead developper  
> Full stack Developper  


## To install and launch
```> Clone this git```

create .env file based on .env_ex file  
```bash
cp .env_ex .env
```  

create config folder for web based on config_ex folder
```bash
cp web/config_ex web/config -R
```  
Make sure permissions are corrects
```bash
sudo chown www-data:root . -R
sudo chmod 775 . -R
```
launch docker wit command  
```bash
sudo docker-compose up -d
```