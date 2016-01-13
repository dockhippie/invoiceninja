FROM webhippie/php-caddy:latest
MAINTAINER Thomas Boerger <thomas@webhippie.de>

VOLUME ["/var/lib/invoiceninja"]

ENTRYPOINT ["/usr/bin/entrypoint"]
CMD ["/bin/s6-svscan", "/etc/s6"]
EXPOSE 8080
WORKDIR /app

ENV INVOICENINJA_VERSION 2.4.9.4
ENV INVOICENINJA_TARBALL https://github.com/invoiceninja/invoiceninja/archive/v${INVOICENINJA_VERSION}.tar.gz

RUN apk update && \
  apk add \
    git && \
  rm -rf \
    /var/cache/apk/*

RUN curl -sLo - \
  ${INVOICENINJA_TARBALL} | tar -xzf - --strip 1 -C /app

RUN composer \
  install \
  --no-dev \
  -n \
  -o \
  --working-dir /app || true

ADD rootfs /
