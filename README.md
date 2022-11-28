# Palestra Web 3

## Smart Contracts

[IDE online](https://remix.ethereum.org).

## DAOs

- [CharityDAO example](https://devpost.com/software/charitydao)

## JamStack IPFS

[Lista de ferramentas](https://jamstack.org/generators/)

[Ferramenta em PHP para gerar sites estáticos](https://jigsaw.tighten.com/)

[Guia para hospedar um site de múltiplas páginas no IPFS](https://docs.ipfs.tech/how-to/websites-on-ipfs/multipage-website/)

```sh
cd jamstack
vendor/bin/jigsaw init
vendor/bin/jigsaw build
vendor/bin/jigsaw serve

ipfs add -r build_local/
ipfs pin add PUT_IPFS_HASH_FOLDER_HERE
ipfs name publish PUT_IPFS_HASH_FOLDER_HERE
ipfs ls /ipns/PUT_IPNS_HASH_HERE
```

[Exemplo de Website](http://gateway.ipfs.io/ipns/k51qzi5uqu5dkg8ej6aq3t8zzc7nduqjdvce4n75wqfah9z3fyzte6m78o97zw)

[Como apontar um domínio via DNS](dnslink.dev)
