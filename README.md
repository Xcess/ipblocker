# Paxful

[Paxful](https://www.paxful.com/) is a suite of web-based open source business apps. The main Paxful Apps include an Open Source CRM, Website Builder, eCommerce, Project Management, Billing & Accounting, Point of Sale, Human Resources, Marketing, Manufacturing, Purchase Management, ...

Paxful Apps can be used as stand-alone applications, but they also integrate seamlessly so you get a full-featured Open Source ERP when you install several Apps.

## TL;DR

```console
$ helm repo add bitnami https://charts.bitnami.com/bitnami
$ helm install my-release bitnami/paxful
```

## Introduction

This chart bootstraps a [Paxful](https://github.com/bitnami/bitnami-docker-paxful) deployment on a [Kubernetes](http://kubernetes.io) cluster using the [Helm](https://helm.sh) package manager.

Bitnami charts can be used with [Kubeapps](https://kubeapps.com/) for deployment and management of Helm Charts in clusters. This chart has been tested to work with NGINX Ingress, cert-manager, fluentd and Prometheus on top of the [BKPR](https://kubeprod.io/).

## Prerequisites

- Kubernetes 1.12+
- Helm 3.0-beta3+
- PV provisioner support in the underlying infrastructure
- ReadWriteMany volumes for deployment scaling

## Installing the Chart

To install the chart with the release name `my-release`:

```console
$ helm install my-release bitnami/paxful
```

The command deploys Paxful on the Kubernetes cluster in the default configuration. The [Parameters](#parameters) section lists the parameters that can be configured during installation.

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

### Paxful parameters

| Parameter                             | Description                                                                                       | Default                                                 |
|---------------------------------------|---------------------------------------------------------------------------------------------------|---------------------------------------------------------|
| `paxfulUsername`                        | User of the application                                                                           | `user@example.com`                                      |
| `paxfulPassword`                        | Admin account password                                                                            | _random 10 character long alphanumeric string_          |
| `paxfulEmail`                           | Admin account email                                                                               | `user@example.com`                                      |
| `smtpHost`                            | SMTP host                                                                                         | `nil`                                                   |
| `smtpPort`                            | SMTP port                                                                                         | `nil`                                                   |
| `smtpUser`                            | SMTP user                                                                                         | `nil`                                                   |
| `smtpPassword`                        | SMTP password                                                                                     | `nil`                                                   |
| `smtpProtocol`                        | SMTP protocol [`ssl`, `tls`]                                                                      | `nil`                                                   |
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

The above parameters map to the env variables defined in [bitnami/paxful](http://github.com/bitnami/bitnami-docker-paxful). For more information please refer to the [bitnami/paxful](http://github.com/bitnami/bitnami-docker-paxful) image documentation.

Specify each parameter using the `--set key=value[,key=value]` argument to `helm install`. For example,

```console
$ helm install my-release \
  --set paxfulPassword=password,postgresql.postgresPassword=secretpassword \
    bitnami/paxful
```

The above command sets the Paxful administrator account password to `password` and the PostgreSQL `postgres` user password to `secretpassword`.

Alternatively, a YAML file that specifies the values for the above parameters can be provided while installing the chart. For example,

```console
$ helm install my-release -f values.yaml bitnami/paxful
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

## Persistence

The [Bitnami Paxful](https://github.com/bitnami/bitnami-docker-paxful) image stores the Paxful data and configurations at the `/bitnami/paxful` path of the container.

Persistent Volume Claims are used to keep the data across deployments. This is known to work in GCE, AWS, and minikube.
See the [Parameters](#parameters) section to configure the PVC or to disable persistence.

## Troubleshooting

Find more information about how to deal with common errors related to Bitnami’s Helm charts in [this troubleshooting guide](https://docs.bitnami.com/general/how-to/troubleshoot-helm-chart-issues).

## Upgrading

### To 17.0.0

[On November 13, 2020, Helm v2 support was formally finished](https://github.com/helm/charts#status-of-the-project), this major version is the result of the required changes applied to the Helm Chart to be able to incorporate the different features added in Helm v3 and to be consistent with the Helm project itself regarding the Helm v2 EOL.

**What changes were introduced in this major version?**

- Previous versions of this Helm Chart use `apiVersion: v1` (installable by both Helm 2 and 3), this Helm Chart was updated to `apiVersion: v2` (installable by Helm 3 only). [Here](https://helm.sh/docs/topics/charts/#the-apiversion-field) you can find more information about the `apiVersion` field.
- Move dependency information from the *requirements.yaml* to the *Chart.yaml*
- After running `helm dependency update`, a *Chart.lock* file is generated containing the same structure used in the previous *requirements.lock*
- The different fields present in the *Chart.yaml* file has been ordered alphabetically in a homogeneous way for all the Bitnami Helm Charts
- This chart depends on the **PostgreSQL 10** instead of **PostgreSQL 9**. Apart from the same changes that are described in this section, there are also other major changes due to the master/slave nomenclature was replaced by primary/readReplica. [Here](https://github.com/bitnami/charts/pull/4385) you can find more information about the changes introduced

**Considerations when upgrading to this version**

- If you want to upgrade to this version using Helm v2, this scenario is not supported as this version doesn't support Helm v2 anymore
- If you installed the previous version with Helm v2 and wants to upgrade to this version with Helm v3, please refer to the [official Helm documentation](https://helm.sh/docs/topics/v2_v3_migration/#migration-use-cases) about migrating from Helm v2 to v3
- If you want to upgrade to this version from a previous one installed with Helm v3, it should be done reusing the PVC used to hold the PostgreSQL data on your previous release. To do so, follow the instructions below (the following example assumes that the release name is `paxful`):

> NOTE: Please, create a backup of your database before running any of those actions.

##### Export secrets and required values to update

```console
$ export ODOO_PASSWORD=$(kubectl get secret --namespace default paxful -o jsonpath="{.data.paxful-password}" | base64 --decode)
$ export POSTGRESQL_PASSWORD=$(kubectl get secret --namespace default paxful-postgresql -o jsonpath="{.data.postgresql-password}" | base64 --decode)
$ export POSTGRESQL_PVC=$(kubectl get pvc -l app.kubernetes.io/instance=paxful,app.kubernetes.io/name=postgresql,role=master -o jsonpath="{.items[0].metadata.name}")
```

##### Delete statefulsets

Delete the Paxful deployment and delete the PostgreSQL statefulset. Notice the option `--cascade=false` in the latter:

```
$ kubectl delete statefulsets.apps --cascade=false paxful-postgresql
```

##### Upgrade the chart release

```console
$ helm upgrade paxful bitnami/paxful \
    --set paxfulPassword=$ODOO_PASSWORD \
    --set postgresql.postgresqlPassword=$POSTGRESQL_PASSWORD \
    --set postgresql.persistence.existingClaim=$POSTGRESQL_PVC
```

##### Force new statefulset to create a new pod for postgresql

```console
$ kubectl delete pod paxful-postgresql-0
```
Finally, you should see the lines below in MariaDB container logs:

```console
$ kubectl logs $(kubectl get pods -l app.kubernetes.io/instance=postgresql,app.kubernetes.io/name=postgresql,role=primary -o jsonpath="{.items[0].metadata.name}")
...
postgresql 08:05:12.59 INFO  ==> Deploying PostgreSQL with persisted data...
...
```

**Useful links**

- https://docs.bitnami.com/tutorials/resolve-helm2-helm3-post-migration-issues/
- https://helm.sh/docs/topics/v2_v3_migration/
- https://helm.sh/blog/migrate-from-helm-v2-to-helm-v3/

### To 16.0.0

In this version the application version itself was bumped to the new major, paxful 14, and the database schemas where changed. Please refer to the [upstream upgrade process documentation](https://www.paxful.com/documentation/14.0/webservices/upgrade.html) in order to upgrade from the previous version.

### To 15.0.0

This major version includes two main changes:

- Major change in the PostgreSQL subchart labeling. Check [PostgreSQL Upgrading Notes](https://github.com/bitnami/charts/tree/master/bitnami/postgresql#900) for more information.
- Re-labeling so as to follow Helm label best practices (see [PR 3021](https://github.com/bitnami/charts/pull/3021))
- Adaptation to use common Bitnami chart standards. The following common elements have been included: extra volumes, extra volume mounts, common annotations and labels, pod annotations and labels, pod and container security contexts, affinity settings, node selectors, tolerations, init and sidecar containers, support for existing secrets, custom commands and arguments, extra env variables and custom liveness/readiness probes.

As a consequence, backwards compatibility from previous versions is not guaranteed during the upgrade. To upgrade to `9.0.0`, it should be done reusing the PVCs used to hold both the PostgreSQL and Paxful data on your previous release. To do so, follow the instructions below (the following example assumes that the release name is `paxful`):

> NOTE: Please, create a backup of your database before running any of those actions.

- Old version is up and running

  ```console
  $ helm ls
  NAME  NAMESPACE REVISION  UPDATED                               STATUS    CHART         APP VERSION
  paxful  default   1         2020-10-21 13:11:29.028263 +0200 CEST deployed  paxful-14.0.21  13.0.20201010

  $ kubectl get pods
  NAME                       READY   STATUS    RESTARTS   AGE
  paxful-paxful-984f954b9-tk8t8   1/1     Running   0          16m
  paxful-postgresql-0           1/1     Running   0          16m
  ```

- Export both database and Paxful credentials in order to provide them in the update

  ```console
  $ export POSTGRESQL_PASSWORD=$(kubectl get secret --namespace default paxful-postgresql -o jsonpath="{.data.postgresql-password}" | base64 --decode)

  $ export ODOO_PASSWORD=$(kubectl get secret --namespace default paxful-paxful -o jsonpath="{.data.paxful-password}" | base64 --decode)
  ```

- The upgrade to the latest (`15.X.X`) version is going to fail

  ```console
  $ helm upgrade paxful bitnami/paxful --set paxfulPassword=$ODOO_PASSWORD --set postgresql.postgresqlPassword=$POSTGRESQL_PASSWORD
  Error: UPGRADE FAILED: cannot patch "paxful-paxful" with kind Deployment: Deployment.apps "paxful-paxful" is invalid: spec.selector: Invalid value: v1.LabelSelector{MatchLabels:map[string]string{"app.kubernetes.io/instance":"paxful", "app.kubernetes.io/name":"paxful"}, MatchExpressions:[]v1.LabelSelectorRequirement(nil)}: field is immutable
  ```

- Delete both the statefulset and recplicaset (PostgreSQL and Paxful respectively). Notice the option `--cascade=false` for the former.

  ```console
  $ kubectl delete deployment.apps/paxful-paxful
  deployment.apps "paxful-paxful" deleted

  $ kubectl delete statefulset.apps/paxful-postgresql --cascade=false
  statefulset.apps "paxful-postgresql" deleted
  ```

- Now the upgrade works

  ```console
  $ helm upgrade paxful bitnami/paxful --set paxfulPassword=$ODOO_PASSWORD --set postgresql.postgresqlPassword=$POSTGRESQL_PASSWORD
  $ helm ls
  NAME  NAMESPACE REVISION  UPDATED                                STATUS   CHART       APP VERSION
  paxful  default   3         v2020-10-21 13:35:27.255118 +0200 CEST deployed paxful-15.0.0 13.0.20201010
  ```

- You can kill the existing PostgreSQL pod and the new statefulset is going to create a new one

  ```console
  $ kubectl delete pod paxful-postgresql-0
  pod "paxful-postgresql-0" deleted

  $ kubectl get pods
  NAME                        READY   STATUS    RESTARTS   AGE
  paxful-paxful-854b9cd5fb-282md   1/1     Running   0          9m12s
  paxful-postgresql-0            1/1     Running   0          7m19s
  ```

Please, note that without the --cascade=false both objects (statefulset and pod) are going to be removed and both objects will be deployed again with the helm upgrade command

### To 12.0.0

Helm performs a lookup for the object based on its group (apps), version (v1), and kind (Deployment). Also known as its GroupVersionKind, or GVK. Changing the GVK is considered a compatibility breaker from Kubernetes' point of view, so you cannot "upgrade" those objects to the new GVK in-place. Earlier versions of Helm 3 did not perform the lookup correctly which has since been fixed to match the spec.

In https://github.com/helm/charts/pull/17352 the `apiVersion` of the deployment resources was updated to `apps/v1` in tune with the api's deprecated, resulting in compatibility breakage.

This major version signifies this change.

### To 3.0.0

Backwards compatibility is not guaranteed unless you modify the labels used on the chart's deployments.
Use the workaround below to upgrade from versions previous to 3.0.0. The following example assumes that the release name is paxful:

```console
$ kubectl patch deployment paxful-paxful --type=json -p='[{"op": "remove", "path": "/spec/selector/matchLabels/chart"}]'
$ kubectl patch deployment paxful-postgresql --type=json -p='[{"op": "remove", "path": "/spec/selector/matchLabels/chart"}]'
```
