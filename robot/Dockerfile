FROM python:3.9.16-bullseye

# UPDATE
RUN pip install --upgrade pip
RUN apt-get update -y
RUN apt-get upgrade -y


# requirements
WORKDIR /
COPY requirements.txt /requirements.txt
RUN pip3 install -r requirements.txt

# LAUNCH
CMD ["python", "/app/main"]