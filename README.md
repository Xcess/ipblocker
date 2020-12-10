# Paxful

This is a test project for Paxful Interview.

## TL;DR

```console
(Only if using minikube:
$ minikube docker-env | source)

$ docker build -t pax:1 ./
$ helm upgrade --install  paxt ./
```

## Prerequisites

- Kubernetes 1.12+
- Helm 3.0-beta3+
- PV provisioner support in the underlying infrastructure (postgres PV)

> **Tip**: List all releases using `helm list`

## Uninstalling the Chart

To uninstall/delete the `my-release` deployment:

```console
$ helm delete my-release
```

The command removes all the Kubernetes components associated with the chart and deletes the release.

## Parameters

The following table lists the configurable parameters of the Paxful chart and their default values.

| Parameter                             | Description                                                                                       | Default                                                 |
|---------------------------------------|---------------------------------------------------------------------------------------------------|---------------------------------------------------------|
| `global.imageRegistry`                | Global Docker image registry                                                                      | `nil`                                                   |
| `global.imagePullSecrets`             | Global Docker registry secret names as an array                                                   | `[]` (does not add image pull secrets to deployed pods) |
| `global.storageClass`                 | Global storage class for dynamic provisioning                                                     | `nil`                                                   |

### Deployment & common parameters

| Parameter                             | Description                                                                                       | Default                                                 |
|---------------------------------------|---------------------------------------------------------------------------------------------------|---------------------------------------------------------|
| `image.registry`                      | Paxful image registry                                                                               | `docker.io`                                             |
| `image.repository`                    | Paxful Image name                                                                                   | `bitnami/paxful`                                          |
| `image.tag`                           | Paxful Image tag                                                                                    | `{TAG_NAME}`                                            |
| `image.pullPolicy`                    | Image pull policy                                                                                 | `Always`                                                |
| `image.pullSecrets`                   | Specify docker-registry secret names as an array                                                  | `[]` (does not add image pull secrets to deployed pods) |
| `nameOverride`                        | String to partially override paxful.fullname template with a string (will prepend the release name) | `nil`                                                   |
| `fullnameOverride`                    | String to fully override paxful.fullname template with a string                                     | `nil`                                                   |
| `commonAnnotations`                   | Annotations to be added to all deployed resources                                                 | `{}` (evaluated as a template)                          |
| `commonLabels`                        | Labels to be added to all deployed resources                                                      | `{}` (evaluated as a template)                          |
| `extraVolumeMounts`                   | Optionally specify extra list of additional volumeMounts for paxful container                       | `[]`                                                    |
| `extraVolumes`                        | Optionally specify extra list of additional volumes for paxful container                            | `[]`                                                    |
| `persistence.enabled`                 | Enable persistence using PVC                                                                      | `true`                                                  |
| `persistence.existingClaim`           | Enable persistence using an existing PVC                                                          | `nil`                                                   |
| `persistence.storageClass`            | PVC Storage Class                                                                                 | `nil` (uses alpha storage class annotation)             |
| `persistence.accessMode`              | PVC Access Mode                                                                                   | `ReadWriteOnce`                                         |
| `persistence.size`                    | PVC Storage Request                                                                               | `8Gi`                                                   |
| `podAffinityPreset`                   | Pod affinity preset. Ignored if `affinity` is set. Allowed values: `soft` or `hard`               | `""`                                                    |
| `podAntiAffinityPreset`               | Pod anti-affinity preset. Ignored if `affinity` is set. Allowed values: `soft` or `hard`          | `soft`                                                  |
| `nodeAffinityPreset.type`             | Node affinity preset type. Ignored if `affinity` is set. Allowed values: `soft` or `hard`         | `""`                                                    |
| `nodeAffinityPreset.key`              | Node label key to match Ignored if `affinity` is set.                                             | `""`                                                    |
| `nodeAffinityPreset.values`           | Node label values to match. Ignored if `affinity` is set.                                         | `[]`                                                    |
| `affinity`                            | Affinity for pod assignment                                                                       | `{}` (evaluated as a template)                          |
| `nodeSelector`                        | Node labels for pod assignment                                                                    | `{}` (evaluated as a template)                          |
| `tolerations`                         | Tolerations for pod assignment                                                                    | `[]` (evaluated as a template)                          |
| `podSecurityContext.enabled`          | Enable security context for Paxful pods                                                             | `true`                                                  |
| `podSecurityContext.fsGroup`          | Group ID for the volumes of the pod                                                               | `1001`                                                  |
| `containerSecurityContext.enabled`    | Paxful Container securityContext                                                                    | `false`                                                 |
| `containerSecurityContext.runAsUser`  | User ID for the Paxful container                                                                    | `1001`                                                  |
| `initContainers`                      | Add additional init containers to the Paxful pods                                                   | `{}` (evaluated as a template)                          |
| `sidecars`                            | Add additional sidecar containers to the Paxful pods                                                | `{}` (evaluated as a template)                          |

### Service parameters

| Parameter                             | Description                                                                                       | Default                                                 |
|---------------------------------------|---------------------------------------------------------------------------------------------------|---------------------------------------------------------|
| `service.type`                        | Kubernetes Service type                                                                           | `LoadBalancer`                                          |
| `service.port`                        | Service HTTP port                                                                                 | `80`                                                    |
| `service.loadBalancer`                | Kubernetes LoadBalancerIP to request                                                              | `nil`                                                   |
| `service.externalTrafficPolicy`       | Enable client source IP preservation                                                              | `Cluster`                                               |
| `service.nodePort`                    | Kubernetes http node port                                                                         | `""`                                                    |

### Custom parameters

| Parameter                             | Description                                                                                       | Default                                                 |
|---------------------------------------|---------------------------------------------------------------------------------------------------|---------------------------------------------------------|
| `smtpHost`                            | SMTP host                                                                                         | `nil`                                                   |
| `smtpPort`                            | SMTP port                                                                                         | `nil`                                                   |
| `smtpUser`                            | SMTP user                                                                                         | `nil`                                                   |
| `existingSecret`                      | Name of a secret with the application password                                                    | `nil`                                                   |
| `resources`                           | CPU/Memory resource requests/limits                                                               | Memory: `512Mi`, CPU: `300m`                            |
| `livenessProbe.enabled`               | Enable/disable the liveness probe                                                                 | `true`                                                  |
| `livenessProbe.initialDelaySeconds`   | Delay before liveness probe is initiated                                                          | 300                                                     |
| `livenessProbe.periodSeconds`         | How often to perform the probe                                                                    | 30                                                      |
| `livenessProbe.timeoutSeconds`        | When the probe times out                                                                          | 5                                                       |
| `livenessProbe.failureThreshold`      | Minimum consecutive failures to be considered failed                                              | 6                                                       |
| `livenessProbe.successThreshold`      | Minimum consecutive successes to be considered successful                                         | 1                                                       |
| `readinessProbe.enabled`              | Enable/disable the readiness probe                                                                | `true`                                                  |
| `readinessProbe.initialDelaySeconds`  | Delay before readinessProbe is initiated                                                          | 30                                                      |
| `readinessProbe.periodSeconds   `     | How often to perform the probe                                                                    | 10                                                      |
| `readinessProbe.timeoutSeconds`       | When the probe times out                                                                          | 5                                                       |
| `readinessProbe.failureThreshold`     | Minimum consecutive failures to be considered failed                                              | 6                                                       |
| `readinessProbe.successThreshold`     | Minimum consecutive successes to be considered successful                                         | 1                                                       |
| `customLivenessProbe`                 | Override default liveness probe                                                                   | `nil`                                                   |
| `customReadinessProbe`                | Override default readiness probe                                                                  | `nil`                                                   |
| `command`                             | Custom command to override image cmd                                                              | `nil` (evaluated as a template)                         |
| `args`                                | Custom args for the custom commad                                                                 | `nil` (evaluated as a template)                         |
| `extraEnvVars`                        | An array to add extra env vars                                                                    | `[]` (evaluated as a template)                          |
| `extraEnvVarsCM`                      | Array to add extra configmaps                                                                     | `[]`                                                    |
| `extraEnvVarsSecret`                  | Array to add extra environment from a Secret                                                      | `nil`                                                   |

### Ingress parameters

| Parameter                             | Description                                                                                       | Default                                                 |
|---------------------------------------|---------------------------------------------------------------------------------------------------|---------------------------------------------------------|
| `ingress.enabled`                     | Enable ingress controller resource                                                                | `false`                                                 |
| `ingress.certManager`                 | Add annotations for cert-manager                                                                  | `false`                                                 |
| `ingress.annotations`                 | Annotations for the ingress                                                                       | `[]` (evaluated as a template)                          |
| `ingress.hosts[0].name`               | Hostname to your Paxful installation                                                                | `paxful.local`                                            |
| `ingress.hosts[0].path`               | Path within the url structure                                                                     | `/`                                                     |
| `ingress.hosts[0].tls`                | Utilize TLS backend in ingress                                                                    | `false`                                                 |
| `ingress.hosts[0].tlsSecret`          | TLS Secret (certificates)                                                                         | `paxful.local-tls-secret`                                 |
| `ingress.secrets[0].name`             | TLS Secret Name                                                                                   | `nil`                                                   |
| `ingress.secrets[0].certificate`      | TLS Secret Certificate                                                                            | `nil`                                                   |
| `ingress.secrets[0].key`              | TLS Secret Key                                                                                    | `nil`                                                   |

### Database parameters

| Parameter                             | Description                                                                                       | Default                                                 |
|---------------------------------------|---------------------------------------------------------------------------------------------------|---------------------------------------------------------|
| `postgresql.enabled`                  | Deploy PostgreSQL container(s)                                                                    | `true`                                                  |
| `postgresql.postgresqlPassword`       | PostgreSQL password                                                                               | `nil`                                                   |
| `postgresql.persistence.enabled`      | Enable PostgreSQL persistence using PVC                                                           | `true`                                                  |
| `postgresql.persistence.storageClass` | PVC Storage Class for PostgreSQL volume                                                           | `nil` (uses alpha storage class annotation)             |
| `postgresql.persistence.accessMode`   | PVC Access Mode for PostgreSQL volume                                                             | `ReadWriteOnce`                                         |
| `postgresql.persistence.size`         | PVC Storage Request for PostgreSQL volume                                                         | `8Gi`                                                   |
| `externalDatabase.host`               | Host of the external database                                                                     | `localhost`                                             |
| `externalDatabase.user`               | Existing username in the external db                                                              | `postgres`                                              |
| `externalDatabase.password`           | Password for the above username                                                                   | `nil`                                                   |
| `externalDatabase.database`           | Name of the existing database                                                                     | `bitnami_paxful`                                          |
| `externalDatabase.port`               | Database port number                                                                              | `5432`                                                  |

Specify each parameter using the `--set key=value[,key=value]` argument to `helm install`. For example,

```console
$ helm install my-release \
  --set paxfulPassword=password,postgresql.postgresPassword=secretpassword \
    ./
```

Alternatively, a YAML file that specifies the values for the above parameters can be provided while installing the chart. For example,

```console
$ helm install my-release -f values.yaml ./
```

> **Tip**: You can use the default [values.yaml](values.yaml)

## Configuration and installation details

### [Rolling VS Immutable tags](https://docs.bitnami.com/containers/how-to/understand-rolling-tags-containers/)

It is strongly recommended to use immutable tags in a production environment. This ensures your deployment does not change automatically if the same tag is updated with a different image.

Bitnami will release a new chart updating its containers if a new version of the main container, significant changes, or critical vulnerabilities exist.

### Change Paxful version

To modify the Paxful version used in this chart you can specify a [valid image tag](https://hub.docker.com/r/bitnami/paxful/tags/) using the `image.tag` parameter. For example, `image.tag=X.Y.Z`. This approach is also applicable to other images like exporters.

### Using an external database

Sometimes you may want to have Paxful connect to an external database rather than installing one inside your cluster, e.g. to use a managed database service, or use a single database server for all your applications. To do this, the chart allows you to specify credentials for an external database under the [`externalDatabase` parameter](#parameters). You should also disable the PostgreSQL installation with the `postgresql.enabled` option. For example using the following parameters:

```console
postgresql.enabled=false
externalDatabase.host=myexternalhost
externalDatabase.user=myuser
externalDatabase.password=mypassword
externalDatabase.port=3306
```

Note also if you disable PostgreSQL per above you MUST supply values for the `externalDatabase` connection.

### Sidecars and Init Containers

If you have a need for additional containers to run within the same pod as Paxful, you can do so via the `sidecars` config parameter. Simply define your container according to the Kubernetes container spec.

```yaml
sidecars:
  - name: your-image-name
    image: your-image
    imagePullPolicy: Always
    ports:
      - name: portname
       containerPort: 1234
```

Similarly, you can add extra init containers using the `initContainers` parameter.

### Setting Pod's affinity

This chart allows you to set your custom affinity using the `affinity` paremeter. Find more infomation about Pod's affinity in the [kubernetes documentation](https://kubernetes.io/docs/concepts/configuration/assign-pod-node/#affinity-and-anti-affinity).

As an alternative, you can use of the preset configurations for pod affinity, pod anti-affinity, and node affinity available at the [bitnami/common](https://github.com/bitnami/charts/tree/master/bitnami/common#affinities) chart. To do so, set the `podAffinityPreset`, `podAntiAffinityPreset`, or `nodeAffinityPreset` parameters.

##### Export secrets and required values to update

```console
$ export PAXFUL_PASSWORD=$(kubectl get secret --namespace default paxful -o jsonpath="{.data.paxful-password}" | base64 --decode)
$ export POSTGRESQL_PASSWORD=$(kubectl get secret --namespace default paxful-postgresql -o jsonpath="{.data.postgresql-password}" | base64 --decode)
$ export POSTGRESQL_PVC=$(kubectl get pvc -l app.kubernetes.io/instance=paxful,app.kubernetes.io/name=postgresql,role=master -o jsonpath="{.items[0].metadata.name}")
```

##### Delete postgresql PVs (purge release)

In order to cpmplete delete the release, you should manually delete postgres PVs. Your data will be lost!

```console
$ kubectl delete pv -l "app.kubernetes.io/instance=paxt"
```
