local pipeline = import 'pipeline.libsonnet';
local name = 'webhippie/invoiceninja';

[
  pipeline.build(name, 'latest', 'latest', 'amd64'),
  pipeline.build(name, 'latest', 'latest', 'arm32v6'),
  pipeline.build(name, 'latest', 'latest', 'arm64v8'),
  pipeline.manifest('latest', 'latest', ['amd64', 'arm32v6', 'arm64v8']),
  pipeline.build(name, 'v2.5', '2.5', 'amd64'),
  pipeline.build(name, 'v2.5', '2.5', 'arm32v6'),
  pipeline.build(name, 'v2.5', '2.5', 'arm64v8'),
  pipeline.manifest('v2.5', '2.5', ['amd64', 'arm32v6', 'arm64v8']),
  pipeline.microbadger(['latest', '2.5']),
]
