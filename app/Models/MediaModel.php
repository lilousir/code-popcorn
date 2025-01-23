<?php

namespace App\Models;

use CodeIgniter\Model;

// Classe pour gérer les opérations CRUD sur la table "media"
class MediaModel extends Model
{
    // Nom de la table associée à ce modèle
    protected $table = 'media';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs autorisés pour les opérations d'écriture (insert/update)
    protected $allowedFields = ['file_path', 'mime_type', 'entity_id', 'entity_type', 'created_at'];

    // Désactivation de la gestion automatique des timestamps
    protected $useTimestamps = false;

    /**
     * Récupère tous les médias avec une limite et un offset pour la pagination.
     *
     * @param int|null $limit Nombre maximum de résultats à récupérer.
     * @param int $offset Décalage pour la pagination.
     * @return array Liste des médias.
     */
    public function getAllMedias($limit = null, $offset = 0)
    {
        return $this->findAll($limit, $offset);
    }

    /**
     * Récupère un média par son ID.
     *
     * @param int|null $id L'identifiant du média à récupérer.
     * @return array|false Les informations du média ou false si l'ID est null.
     */
    public function getMediaById($id = null)
    {
        if ($id == null) {
            return false; // Retourne false si aucun ID n'est fourni
        }
        return $this->find($id); // Utilise la méthode find() pour récupérer les données
    }

    /**
     * Supprime un média (fichier physique et entrée en base de données).
     *
     * @param int $id L'identifiant du média à supprimer.
     * @return bool True si la suppression est réussie, False sinon.
     */
    public function deleteMedia($id)
    {
        // Récupérer les informations du fichier depuis la base de données
        $fichier = $this->find($id);
        if ($fichier) {
            // Construit le chemin complet du fichier sur le serveur
            $chemin = FCPATH . $fichier['file_path'];

            // Vérifie si le fichier existe
            if (file_exists($chemin)) {
                // Supprime le fichier physique
                unlink($chemin);

                // Supprime l'entrée en base de données
                return $this->delete($id);
            }
        }

        return false; // Retourne false si le fichier ou son entrée n'est pas trouvé
    }

    /**
     * Récupère tous les médias associés à un type d'entité donné.
     *
     * @param string $entityType Le type d'entité (ex : 'theater', 'user').
     * @param int|null $limit Nombre maximum de résultats à récupérer.
     * @param int $offset Décalage pour la pagination.
     * @return array Liste des médias associés au type d'entité.
     */
    public function getAllMediasByEntityType($entityType, $limit = null, $offset = 0)
    {
        return $this->where('entity_type', $entityType)->findAll($limit, $offset);
    }

    /**
     * Récupère tous les médias associés à un ID et un type d'entité donnés.
     *
     * @param int $entityId L'ID de l'entité associée.
     * @param string $entityType Le type d'entité associée.
     * @return array Liste des médias associés.
     */
    public function getMediaByEntityIdAndType($entityId, $entityType)
    {
        return $this->where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->findAll();
    }

    /**
     * Récupère le premier média associé à un ID et un type d'entité donnés.
     *
     * @param int $entityId L'ID de l'entité associée.
     * @param string $entityType Le type d'entité associée.
     * @return array|null Les informations du média ou null si aucun média n'est trouvé.
     */
    public function getFirstMediaByEntityIdAndType($entityId, $entityType)
    {
        return $this->where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->first();
    }
}
