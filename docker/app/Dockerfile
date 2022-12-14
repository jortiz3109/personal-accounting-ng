FROM debian

LABEL maintainer="John Edisson Ortiz"

ARG NODE_VERSION=16

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt update \
    && apt -y upgrade \
    && apt install -y lsb-release ca-certificates apt-transport-https software-properties-common gnupg2 curl apt-utils gosu

RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list \
    && curl -fsSL  https://packages.sury.org/php/apt.gpg | gpg --dearmor -o /etc/apt/trusted.gpg.d/sury-keyring.gpg

RUN apt update \
    && apt install -y php8.1 php8.1-cli \
        php8.1-curl php8.1-mysql php8.1-mbstring  \
        php8.1-xml php8.1-zip php8.1-bcmath php8.1-soap \
        php8.1-intl php8.1-readline php8.1-redis php8.1-xdebug \
        php8.1-gd php8.1-bz2

RUN curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt install -y nodejs \
    && npm install -g npm

RUN apt install -y mariadb-client supervisor\
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN useradd -ms /bin/bash --no-user-group -u 1000 app
RUN mkdir -p /home/app/.composer \
    && chown -R app /home/app/.composer

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php/8.1/cli/conf.d/99-app.ini
RUN chmod +x /usr/local/bin/start-container

WORKDIR /var/www/html

USER app
ENTRYPOINT ["start-container"]
