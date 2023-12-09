# Creation process

docker build -t gatsby-env -f build/Dockerfile.dev ./

docker run --name gatsby-env -v "$PWD":/usr/src/app -w /usr/src/app -it gatsby-env sh

>npx gatsby new

# Development 

docker run --name gatsby-env -p 8000:8000 -v "$PWD/app":/usr/src/app -w /usr/src/app -it gatsby-env sh