# Image officielle minimale PHP 8.2 en mode CLI
FROM php:8.2-cli-alpine

# Répertoire de travail isolé
WORKDIR /app

# Copier l'intégralité du code source
COPY . .

# Exécuter les tests pendant la construction de l'image
# Le build échoue automatiquement si un test échoue
RUN php tests/run.php

# Commande exécutée au démarrage du conteneur
CMD ["php", "index.php"]