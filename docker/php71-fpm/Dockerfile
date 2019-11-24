FROM debian:stable-slim
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive
ENV TERM=linux

RUN apt-get update \
	&& apt-get -y --no-install-recommends install curl wget gcc make autoconf libc-dev pkg-config libgpgme11-dev \
	gnupg2 ca-certificates lsb-release apt-transport-https git unzip xmlsec1 \
	&& wget https://packages.sury.org/php/apt.gpg \
	&& apt-key add apt.gpg \
	&& echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php7.list \
	&& apt-get update \
	&& apt-get install -y --no-install-recommends php7.1-fpm php7.1-intl php7.1-zip php7.1-xsl php7.1-mbstring \
	&& apt-get -y install php7.1-dev php-pear \
	&& pecl channel-update pecl.php.net \
	&& pecl install gnupg \
	&& echo "extension=gnupg.so" | tee /etc/php/7.1/mods-available/gnupg.ini \
    && ln -s /etc/php/7.1/mods-available/gnupg.ini /etc/php/7.1/cli/conf.d/20-gnupg.ini \
	&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* ~/.composer

EXPOSE 9000

#CMD ["php", "-a"]
#CMD ["tail", "-f", "/dev/null"]
