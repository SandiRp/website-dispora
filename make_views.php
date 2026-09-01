<?php
$viewsDir = __DIR__ . '/resources/views/admin';
$resources = [
    'services' => [
        'name' => 'Layanan',
        'route' => 'admin.services',
        'fields' => [
            ['name' => 'name', 'label' => 'Nama Layanan', 'type' => 'text'],
            ['name' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea'],
            ['name' => 'url_link', 'label' => 'URL Tautan', 'type' => 'url'],
            ['name' => 'icon_path', 'label' => 'Ikon Layanan (Gambar)', 'type' => 'file'],
            ['name' => 'order', 'label' => 'Urutan', 'type' => 'number'],
            ['name' => 'is_active', 'label' => 'Aktif', 'type' => 'checkbox']
        ]
    ],
    'connected_apps' => [
        'name' => 'Aplikasi Terhubung',
        'route' => 'admin.connected_apps',
        'fields' => [
            ['name' => 'name', 'label' => 'Nama Aplikasi', 'type' => 'text'],
            ['name' => 'description', 'label' => 'Deskripsi', 'type' => 'textarea'],
            ['name' => 'url_link', 'label' => 'URL Tautan', 'type' => 'url'],
            ['name' => 'logo_path', 'label' => 'Logo Aplikasi (Gambar)', 'type' => 'file'],
            ['name' => 'order', 'label' => 'Urutan', 'type' => 'number'],
            ['name' => 'is_active', 'label' => 'Aktif', 'type' => 'checkbox']
        ]
    ],
    'skm_data' => [
        'name' => 'Data SKM',
        'route' => 'admin.skm_data',
        'fields' => [
            ['name' => 'year', 'label' => 'Tahun', 'type' => 'number'],
            ['name' => 'period', 'label' => 'Periode', 'type' => 'text'],
            ['name' => 'index_value', 'label' => 'Nilai Indeks', 'type' => 'text'],
            ['name' => 'category', 'label' => 'Kategori (Mutu)', 'type' => 'text'],
            ['name' => 'doc_path', 'label' => 'Dokumen Laporan (PDF)', 'type' => 'file'],
            ['name' => 'is_published', 'label' => 'Publikasikan', 'type' => 'checkbox']
        ]
    ],
    'social_medias' => [
        'name' => 'Sosial Media',
        'route' => 'admin.social_medias',
        'fields' => [
            ['name' => 'platform', 'label' => 'Platform', 'type' => 'text'],
            ['name' => 'account_name', 'label' => 'Nama Akun', 'type' => 'text'],
            ['name' => 'url_link', 'label' => 'URL Tautan', 'type' => 'url'],
            ['name' => 'icon_class', 'label' => 'Class Ikon', 'type' => 'text'],
            ['name' => 'is_active', 'label' => 'Aktif', 'type' => 'checkbox']
        ]
    ]
];

foreach ($resources as $dir => $config) {
    $resDir = $viewsDir . '/' . $dir;
    if (!is_dir($resDir)) mkdir($resDir, 0777, true);
    
    // index.blade.php
    $index = "<x-app-layout>
    <x-slot name=\"header\">
        <div class=\"flex justify-between items-center\">
            <h2 class=\"font-semibold text-xl text-gray-800 leading-tight\">
                {{ __('Kelola {$config['name']}') }}
            </h2>
            <a href=\"{{ route('{$config['route']}.create') }}\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">
                Tambah {$config['name']}
            </a>
        </div>
    </x-slot>

    <div class=\"py-12\">
        <div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\">
            <div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\">
                <div class=\"p-6 text-gray-900\">
                    @if(session('success'))
                        <div class=\"bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4\" role=\"alert\">
                            <span class=\"block sm:inline\">{{ session('success') }}</span>
                        </div>
                    @endif
                    <table class=\"min-w-full divide-y divide-gray-200\">
                        <thead class=\"bg-gray-50\">
                            <tr>
                                <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider\">ID</th>
                                <th class=\"px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider\">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class=\"bg-white divide-y divide-gray-200\">
                            @foreach(${$config['route']} as \$item)
                            <tr>
                                <td class=\"px-6 py-4 whitespace-nowrap\">{{ \$item->id }}</td>
                                <td class=\"px-6 py-4 whitespace-nowrap\">
                                    <a href=\"{{ route('{$config['route']}.edit', \$item) }}\" class=\"text-indigo-600 hover:text-indigo-900 mr-2\">Edit</a>
                                    <form action=\"{{ route('{$config['route']}.destroy', \$item) }}\" method=\"POST\" class=\"inline-block\">
                                        @csrf
                                        @method('DELETE')
                                        <button type=\"submit\" class=\"text-red-600 hover:text-red-900\" onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>";

    file_put_contents($resDir . '/index.blade.php', str_replace('$admin.services', '$services', str_replace('$admin.connected_apps', '$apps', str_replace('$admin.skm_data', '$skmData', str_replace('$admin.social_medias', '$socialMedias', $index)))));

    // create.blade.php
    $create = "<x-app-layout>
    <x-slot name=\"header\">
        <h2 class=\"font-semibold text-xl text-gray-800 leading-tight\">
            {{ __('Tambah {$config['name']}') }}
        </h2>
    </x-slot>

    <div class=\"py-12\">
        <div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\">
            <div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\">
                <div class=\"p-6 text-gray-900\">
                    <form action=\"{{ route('{$config['route']}.store') }}\" method=\"POST\" enctype=\"multipart/form-data\">
                        @csrf\n";
    foreach ($config['fields'] as $f) {
        $create .= "                        <div class=\"mb-4\">\n";
        $create .= "                            <label for=\"{$f['name']}\" class=\"block text-sm font-medium text-gray-700\">{$f['label']}</label>\n";
        if ($f['type'] == 'textarea') {
            $create .= "                            <textarea name=\"{$f['name']}\" id=\"{$f['name']}\" rows=\"3\" class=\"mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm\">{{ old('{$f['name']}') }}</textarea>\n";
        } elseif ($f['type'] == 'checkbox') {
            $create .= "                            <input type=\"checkbox\" name=\"{$f['name']}\" id=\"{$f['name']}\" class=\"mt-1\" value=\"1\" {{ old('{$f['name']}') ? 'checked' : '' }}>\n";
        } else {
            $create .= "                            <input type=\"{$f['type']}\" name=\"{$f['name']}\" id=\"{$f['name']}\" class=\"mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm\" value=\"{{ old('{$f['name']}') }}\">\n";
        }
        $create .= "                        </div>\n";
    }
    $create .= "                        <div class=\"mb-6 flex justify-end\">
                            <a href=\"{{ route('{$config['route']}.index') }}\" class=\"bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2\">Batal</a>
                            <button type=\"submit\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>";

    file_put_contents($resDir . '/create.blade.php', $create);

    // edit.blade.php
    $edit = "<x-app-layout>
    <x-slot name=\"header\">
        <h2 class=\"font-semibold text-xl text-gray-800 leading-tight\">
            {{ __('Edit {$config['name']}') }}
        </h2>
    </x-slot>

    <div class=\"py-12\">
        <div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\">
            <div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\">
                <div class=\"p-6 text-gray-900\">
                    @php \$item = \$" . str_replace('admin.', '', rtrim($config['route'], 's')) . "; @endphp\n";
    if ($dir == 'social_medias') $edit = str_replace('$social_media', '$socialMedia', $edit);
    if ($dir == 'skm_data') $edit = str_replace('$skm_data', '$skmDatum', $edit);
    if ($dir == 'connected_apps') $edit = str_replace('$connected_app', '$connectedApp', $edit);

    $edit .= "                    <form action=\"{{ route('{$config['route']}.update', \$item) }}\" method=\"POST\" enctype=\"multipart/form-data\">
                        @csrf
                        @method('PUT')\n";
    
    foreach ($config['fields'] as $f) {
        $edit .= "                        <div class=\"mb-4\">\n";
        $edit .= "                            <label for=\"{$f['name']}\" class=\"block text-sm font-medium text-gray-700\">{$f['label']}</label>\n";
        if ($f['type'] == 'textarea') {
            $edit .= "                            <textarea name=\"{$f['name']}\" id=\"{$f['name']}\" rows=\"3\" class=\"mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm\">{{ old('{$f['name']}', \$item->{$f['name']}) }}</textarea>\n";
        } elseif ($f['type'] == 'checkbox') {
            $edit .= "                            <input type=\"checkbox\" name=\"{$f['name']}\" id=\"{$f['name']}\" class=\"mt-1\" value=\"1\" {{ old('{$f['name']}', \$item->{$f['name']}) ? 'checked' : '' }}>\n";
        } elseif ($f['type'] == 'file') {
            $edit .= "                            @if(\$item->{$f['name']})
                                <div class=\"mb-2 text-sm text-gray-600\">File saat ini: <a href=\"{{ Storage::url(\$item->{$f['name']}) }}\" target=\"_blank\">Lihat</a></div>
                            @endif\n";
            $edit .= "                            <input type=\"{$f['type']}\" name=\"{$f['name']}\" id=\"{$f['name']}\" class=\"mt-1 block w-full text-sm text-gray-500\">\n";
        } else {
            $edit .= "                            <input type=\"{$f['type']}\" name=\"{$f['name']}\" id=\"{$f['name']}\" class=\"mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm\" value=\"{{ old('{$f['name']}', \$item->{$f['name']}) }}\">\n";
        }
        $edit .= "                        </div>\n";
    }
    
    $edit .= "                        <div class=\"mb-6 flex justify-end\">
                            <a href=\"{{ route('{$config['route']}.index') }}\" class=\"bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2\">Batal</a>
                            <button type=\"submit\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded\">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>";

    file_put_contents($resDir . '/edit.blade.php', $edit);
}

echo "Views generated successfully.\n";
