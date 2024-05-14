```mermaid
block-beta
columns 1
Core
space
block
    f1["Feature 1"]
    f2["Feature 2"]
    f3["Feature 3"]
end
f1 --> Core
f2 --> Core
f3 --> Core
```
The core is here to centralize all the logic related to WordPress plugins and leave the business logic only to the plugin developers.

Each plugin using the core is interacting with it to handle logic related to the common plugin tasks.

This way it is possible to focus only on business logic while developing plugins.

## Advantage of using one core

### Code duplication
When using the core the code used for plugin logic will be shared between all teams.

This way the code duplication between teams will be reduced as only the business logic will remain which is heavily linked to the business requirements from that plugin and so unique.
```mermaid
block-beta
    columns 2

    block
        columns 3
        Plugin1["Plugin 1 (WP Rocket)"]:3
        Core1:3
        space
        space
        space
        f1["Feature 1"]
        f2["Feature 2"]
        f3["Feature 3"]
    end

    block
        columns 3
        Plugin2["Plugin 2 (Imagify)"]:3
        Core2:3
        space
        space
        space
        f4["Feature 4"]
        f5["Feature 5"]
        f6["Feature 6"]
    end

    f1 --> Core1
    f2 --> Core1
    f3 --> Core1
    f4 --> Core2
    f5 --> Core2
    f6 --> Core2

    style Plugin1 fill:grey,stroke:#333,stroke-width:4px
    style Plugin2 fill:grey,stroke:#333,stroke-width:4px
```
Without a common core
```mermaid
block-beta
columns 2
    
block
    columns 3
    Plugin1["Plugin 1 (WP Rocket)"]:3
    Core1["Core"]:3
    space
    space
    space
    f1["Feature 1"]
    f2["Feature 2"]
    f3["Feature 3"]
end

block
    columns 3
    Plugin2["Plugin 2 (Imagify)"]:3
    Core2["Core"]:3
    space
    space
    space
    f4["Feature 4"]
    f5["Feature 5"]
    f6["Feature 6"]
end

f1 --> Core1
f2 --> Core1
f3 --> Core1
f4 --> Core2
f5 --> Core2
f6 --> Core2

style Plugin1 fill:grey,stroke:#333,stroke-width:4px
style Plugin2 fill:grey,stroke:#333,stroke-width:4px
```
With a common core
### Code disparity

The core comes with an architecture but also recommendations which are common to all the projects.

This way the code will be working and organized a similar way between each plugin, and it will be easier to switch from one to another when it is necessary. 

### Interoperability

As the only interface needed by the core to load a feature is the service provider from that feature, it will be now possible to create libraries or features which going to be common to multiple plugins.

That preventing again code duplication between plugins but also enhancing interoperability from the code.
```mermaid
block-beta
    columns 2

    block
        columns 3
        Plugin1["Plugin 1 (WP Rocket)"]:3
        Core1:3
        space
        space
        space
        f1["Feature 1"]
        f2["Feature 2"]
        f3["Feature 3"]
    end

    block
        columns 3
        Plugin2["Plugin 2 (Imagify)"]:3
        Core2:3
        space
        space
        space
        f4["Feature 4"]
        f5["Feature 5"]
        f6["Feature 3"]
    end

    f1 --> Core1
    f2 --> Core1
    f3 --> Core1
    f4 --> Core2
    f5 --> Core2
    f6 --> Core2

    style Plugin1 fill:grey,stroke:#333,stroke-width:4px
    style Plugin2 fill:grey,stroke:#333,stroke-width:4px
```
Using a common core allows to have this situation possible without reimplementing Feature 3 twice.

## Loading

Video: 

[![alt text](imgs/booting-process.png "Loading explanations")](https://www.loom.com/share/c5a244a483f440249ac1353a9c23c623?sid=3876d2d5-586c-4021-bae9-bd2266c3a839)

```mermaid
sequenceDiagram
    participant boot file
    participant Core
    participant Container
    participant Event manager
    participant Service provider

boot file ->> boot file: Require parameters file
boot file ->> boot file: Require service provider file
boot file ->> boot file: Register translations
boot file ->> boot file: Require Composer autoloader
boot file ->> Container: Initialize the container
boot file ->> Event manager: Initialize the event manager
boot file ->> Core: Initialize the core with the container and the event manager
boot file ->> Core: Load the core with parameters and service provider
    loop each service provider
        Core ->> Container: Attach service provider
    end
    loop each service provider
        Core ->> Service provider: Fetch subscribers
        loop each subscriber
            Core ->> Container: Initialize subscriber
            Core ->> Event manager: Register subscriber to WordPress API
        end
    end
```
When loading the core follows this steps:
- It loads the parameters from the plugin
- It loads the service providers from the plugin
- It registers translations for the WordPress environment
- It loads Composer autoloader which going to allow the usage from libraries
- It initializes the container which going to be used later on to provide access to any class within the plugin
- It initializes the event manager which link subscribers with the WordPress API.
- It calls the `load` method from the `Core` to load the plugin 
- It registers each service providers on the container giving access to the class from the features.
- For each service provider it fetches the list of subscribers:
  - It instantiates the subscriber
  - It registers it to the WordPress API through the event manager

