FROM node:22

WORKDIR /app

COPY ./app/package*.json /app
RUN npm install

COPY . .

EXPOSE 3000
