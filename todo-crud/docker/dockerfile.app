FROM node:22

WORKDIR /workspace

COPY ./app/package*.json /workspace/app/
RUN npm install --prefix ./app

COPY . .

EXPOSE 3000
