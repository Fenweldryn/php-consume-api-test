FROM node:22.5.1-alpine AS build-stage

WORKDIR /app

COPY ./frontend/package.json ./

RUN npm install

COPY ./frontend .

RUN npm run build

FROM nginx:stable-alpine as production-stage

COPY --from=build-stage /app/dist /usr/share/nginx/html

COPY ./frontend/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]