
<?php

class Bibliotheque
{
    private array $livres = [];

    public function ajouter(Livre $l): void
    {
        if ($this->trouver($l->getIsbn()) !== null) {
            throw new Exception("Ce livre existe déjà.");
        }

        $this->livres[] = $l;
    }

    public function trouver(string $isbn): ?Livre
    {
        foreach ($this->livres as $livre) {
            if ($livre->getIsbn() === $isbn) {
                return $livre;
            }
        }

        return null;
    }

    public function tous(): array
    {
        return $this->livres;
    }

    public function compter(): int
    {
        return count($this->livres);
    }

    public function statistiques(): array
    {
        $total = count($this->livres);
        $disponibles = 0;
        $empruntes = 0;

        foreach ($this->livres as $livre) {
            if ($livre->estDisponible()) {
                $disponibles++;
            } else {
                $empruntes++;
            }
        }

        return [
            'total' => $total,
            'disponibles' => $disponibles,
            'empruntes' => $empruntes
        ];
    }

    public function rechercher(string $mot): array
    {
        $resultats = [];

        foreach ($this->livres as $livre) {
            if (
                stripos($livre->getTitre(), $mot) !== false ||
                stripos($livre->getAuteur(), $mot) !== false
            ) {
                $resultats[] = $livre;
            }
        }

        return $resultats;
    }
}
