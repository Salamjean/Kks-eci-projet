@extends('vendor.agent.layouts.template')

@section('content')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-xl rounded-xl overflow-hidden">
            <!-- Header with romantic gradient -->
           <div class=" px-6 py-5" style="background-color: #6777ef">
                <h2 class="text-2xl font-bold text-white">Mise à jour de l'état de la demande</h2>
                <p class="text-pink-100 mt-1">Extrait de mariage - Gestion des demandes</p>
            </div>
            
            <!-- Form Container -->
            <div class="p-6 space-y-6">
                <form action="{{ route('mariage.updateEtat', $mariage->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('POST')

                    <!-- Applicant Information -->
                    <div class="space-y-2">
                        <label for="nomDefunt" class="block text-sm font-medium text-gray-700">Nom de l'époux</label>
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <input type="text" id="nomDefunt" 
                                   class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200" 
                                   value="{{ $mariage->user->name .' '.$mariage->user->prenom }}" 
                                   disabled>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status Selection -->
                    <div class="space-y-2">
                        <label for="etat" class="block text-sm font-medium text-gray-700">État de la demande</label>
                        <div class="relative">
                            <select name="etat" id="etat" 
                                    class="appearance-none block w-full px-4 py-3 bg-white border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200">
                                @foreach($etats as $etat)
                                    <option value="{{ $etat }}" {{ $mariage->etat == $etat ? 'selected' : '' }}>
                                        {{ ucfirst($etat) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-4" >
                        <a href="{{ url()->previous() }}" style="background-color: red" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-white  hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition duration-200">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition duration-200" style="background-color: #6777ef">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection