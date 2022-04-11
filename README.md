**Magento 2 Ebit** 

 **Instalação via Composer**

```
composer config repositories.bizcommerce-ebit git https://bitbucket.org/biz-commerce/ebit.git
composer require biz-commerce/ebit:dev-master

php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy pt_BR en_US
```

**Configurações** 

+ Modulo se encontra em `Lojas > Configurações > Biz > Ebit`

![Configuraçao_Modulo_Admin](docs/configuracao_modulo.png)

* [x] Ativar Banner Habilitara Um Banner ao Finalizar o Pedido no Checkout.

![banner](docs/banner.png)


* [x] Ativar Lightbox Habilitara uma Janela ao Finalizar o Pedido, onde o cliente avaliara a experiencia de compra.

![Configuraçao_Modulo_Admin](docs/lighbox.png)


* [x] Store id Ebit E Necessario para inserir a loja que sera avalidado pelo cliente junto a ebit.

* [x] ```Observação E Necessario um Store ID Valido para que seja possivel realizar o Fluxo corretamente```.





