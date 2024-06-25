# invoiceninja

[![Docker Build](https://github.com/dockhippie/invoiceninja/actions/workflows/docker.yml/badge.svg)](https://github.com/dockhippie/invoiceninja/actions/workflows/docker.yml) [![GitHub Repo](https://img.shields.io/badge/github-repo-yellowgreen)](https://github.com/dockhippie/invoiceninja)

These are docker images for [Invoiceninja][upstream] running on our
[Apache PHP image][parent].

## Versions

For the available versions please look at [Docker Hub][dockerhub] or
[Quay][quayio] or check the existing folders within the
[GitHub repository][github].

## Volumes

*  /var/lib/invoiceninja

## Ports

*  8080

## Available environment variables

```console

```

## Inherited environment variables

*  [webhippie/php-apache](https://github.com/dockhippie/php-apache#available-environment-variables)
*  [webhippie/apache](https://github.com/dockhippie/apache#available-environment-variables)
*  [webhippie/alpine](https://github.com/dockhippie/alpine#available-environment-variables)

## Contributing

Fork -> Patch -> Push -> Pull Request

## Authors

*  [Thomas Boerger](https://github.com/tboerger)

## License

MIT

## Copyright

```console
Copyright (c) 2015 Thomas Boerger <http://www.webhippie.de>
```

[upstream]: https://www.invoiceninja.com/
[parent]: https://github.com/dockhippie/php-apache
[dockerhub]: https://hub.docker.com/r/webhippie/invoiceninja/tags
[quayio]: https://quay.io/repository/webhippie/invoiceninja?tab=tags
[github]: https://github.com/dockhippie/invoiceninja
