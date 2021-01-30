# Spark
## Git
### Ajouter une fonctionnalité au *projet*
1. Positionnez vous sur la branche **master** : `git checkout master`
2. Mettez à jour votre branche master :
`git pull origin master`
3.  1. Créez une nouvelle branche avec un nom en rapport avec ce que vous voulez ajoutez :
    `git branch login-page` puis `git checkout login-page` ou vous pouvez directement faire `git checkout -b login-page` ce qui revient à faire les deux
    2. Pour le nommage des branches vous pouvez les préfixez de mot comme `fix/ma-mabranche` pour un fix ou `feature/` pour une fonctionnalité etc...
4. Vous faites des commits sur cette branche
5. Assurez vous d'être bien à jour avec la branche master, pour cela retournez sur votre branche master en local `git checkout master` et faites un `git pull origin master` retournez sur votre branche `git checkout page-login` et faite un rebase `git rebase master`
6. Vous pouvez pousser votre branche qui contient vos changements `git push origin page-login` ce qui va créer une branche identique à celle que vous avez en local sur le repo distant
7. Créez une pull request sur github vous pouvez la préfixez de `WIP` si votre travail n'est pas terminé. Vous pouvez rédigez une description de ce que vous avez fais ou des changements sur le projet que votre branche provoque...
8. Enfin, après la vérification de plusieurs personnes (ex: 2 emoji pouce :thumbsup: minimum) on peut mergé la branche dans master
9. Les modifications urgentes comme la correction de bugs bloquants pourront être mergés directement.
10. Vous pouvez faire un `git push origin ma-branche` si la pull request existe déjà pour cette branche elle se mettra à jour automatiquement
* bonjour
* fww
* fefe
