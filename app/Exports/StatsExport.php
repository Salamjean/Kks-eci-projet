<?php 
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Ajout pour l'ajustement automatique des colonnes

use App\Models\NaissHop;
use App\Models\DecesHop;
use Illuminate\Support\Facades\Auth;

class StatsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    private $selectedMonth;
    private $selectedYear;
    private $sousAdminId;
    private $communeAdmin;

    public function __construct(int $selectedMonth, int $selectedYear, int $sousAdminId, string $communeAdmin)
    {
        $this->selectedMonth = $selectedMonth;
        $this->selectedYear = $selectedYear;
        $this->sousAdminId = $sousAdminId;
        $this->communeAdmin = $communeAdmin;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Récupérer les données combinées des naissances et des décès
        $naissances = NaissHop::where('NomEnf', $this->communeAdmin)
            ->whereMonth('created_at', $this->selectedMonth)
            ->where('sous_admin_id', $this->sousAdminId)
            ->whereYear('created_at', $this->selectedYear)
            ->get();

        $deces = DecesHop::where('nomHop', $this->communeAdmin)
            ->whereMonth('created_at', $this->selectedMonth)
            ->where('sous_admin_id', $this->sousAdminId)
            ->whereYear('created_at', $this->selectedYear)
            ->get();

        // Transformer les données pour l'export (vous pouvez adapter les champs)
        $data = collect();

        foreach ($naissances as $naissance) {
            $data->push([
                'type' => 'Naissance',
                'date' => $naissance->created_at,
                'nom_enfant' => $naissance->NomEnf, // Remplacez par les champs pertinents
                // Ajoutez d'autres champs de NaissHop ici
            ]);
        }

        foreach ($deces as $dece) {
            $data->push([
                'type' => 'Décès',
                'date' => $dece->created_at,
                'nom_hopital' => $dece->nomHop, // Remplacez par les champs pertinents
                // Ajoutez d'autres champs de DecesHop ici
            ]);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Type',
            'Date',
            'Nom et prénoms de la mère',  // Adaptez ce titre
            'Hôpital',  // Adaptez ce titre
            // Ajoutez d'autres en-têtes de colonne ici
        ];
    }
}
