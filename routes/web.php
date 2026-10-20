<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    $latestPosts = \App\Models\Post::latestPublished()->take(10)->get();
    
    $gubernurPosts = \App\Models\Post::latestPublished()->whereHas('category', function($q) {
        $q->where('name', 'like', '%Gubernur%')->orWhere('slug', 'like', '%gubernur%');
    })->take(10)->get();
    
    $upcomingAgendas = \App\Models\Agenda::whereIn('status', ['upcoming', 'ongoing'])->orderBy('start_date', 'asc')->take(5)->get();
        
    $latestSkm = \App\Models\SkmData::where('is_active', true)->where('is_published', true)->orderBy('year', 'desc')->orderBy('period', 'desc')->first();
    $allSkm = \App\Models\SkmData::where('is_published', true)->orderBy('year', 'desc')->orderBy('period', 'desc')->get();
    $services = \App\Models\Service::where('is_active', true)->orderBy('order')->get();
    $connectedApps = \App\Models\ConnectedApp::where('is_active', true)->orderBy('order')->get();
    $socialMedias = \App\Models\SocialMedia::where('is_active', true)->get();
    $venues = \App\Models\Venue::where('is_active', true)->orderBy('order')->get();
    $officialLogos = \App\Models\OfficialLogo::where('is_active', true)->orderBy('order')->orderBy('created_at', 'desc')->take(4)->get();
    $announcements = \App\Models\Announcement::currentlyActive()->orderBy('order')->get();
    
    return view('welcome', compact('latestPosts', 'gubernurPosts', 'upcomingAgendas', 'latestSkm', 'allSkm', 'services', 'connectedApps', 'socialMedias', 'venues', 'officialLogos', 'announcements'));
});

Route::get('/dashboard', function () {
    $stats = [
        'posts'   => \App\Models\Post::count(),
        'agendas' => \App\Models\Agenda::count(),
        'services' => \App\Models\Service::where('is_active', true)->count(),
        'apps'    => \App\Models\ConnectedApp::where('is_active', true)->count(),
        'skm'     => \App\Models\SkmData::where('is_published', true)->count(),
        'socmed'  => \App\Models\SocialMedia::where('is_active', true)->count(),
    ];
    $recentAgendas = \App\Models\Agenda::orderBy('start_date', 'asc')->take(5)->get();
    $latestSkm = \App\Models\SkmData::where('is_published', true)->orderBy('year', 'desc')->first();
    return view('dashboard', compact('stats', 'recentAgendas', 'latestSkm'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/Halprofil', function () {
    $officials = \App\Models\Official::orderBy('order')->get();
    return view('Halprofil', compact('officials'));
});
Route::get('/program', function () {
    $renjaDocs = \App\Models\Document::whereHas('category', function($q) { 
        $q->where('name', 'like', '%Renja%')->orWhere('name', 'like', '%Rencana Kerja%'); 
    })->where('access_type', 'public')->latest()->get();
    
    $renstraDocs = \App\Models\Document::whereHas('category', function($q) { 
        $q->where('name', 'like', '%Renstra%')->orWhere('name', 'like', '%Rencana Strategis%'); 
    })->where('access_type', 'public')->latest()->get();
    
    $lkjipDocs = \App\Models\Document::whereHas('category', function($q) { 
        $q->where('name', 'like', '%LKJIP%')->orWhere('name', 'like', '%Laporan Kinerja%'); 
    })->where('access_type', 'public')->latest()->get();
    
    $pkDocs = \App\Models\Document::whereHas('category', function($q) { 
        $q->where('name', 'like', '%PK%')->orWhere('name', 'like', '%Perjanjian Kinerja%'); 
    })->where('access_type', 'public')->latest()->get();
    
    return view('program', compact('renjaDocs', 'renstraDocs', 'lkjipDocs', 'pkDocs'));
});

Route::get('/laporan', function () {
    $dpaDocs = \App\Models\Document::whereHas('category', function($q) { 
        $q->where('name', 'DPA'); 
    })->where('access_type', 'public')->latest()->get();
    
    $asetDocs = \App\Models\Document::whereHas('category', function($q) { 
        $q->where('name', 'ASET'); 
    })->where('access_type', 'public')->latest()->get();
    
    $lraDocs = \App\Models\Document::whereHas('category', function($q) { 
        $q->where('name', 'LRA'); 
    })->where('access_type', 'public')->latest()->get();
    
    return view('laporan', compact('dpaDocs', 'asetDocs', 'lraDocs'));
});

Route::get('/logo-resmi', function () {
    $logos = \App\Models\OfficialLogo::where('is_active', true)->orderBy('order')->orderBy('created_at', 'desc')->get();
    return view('official-logos', compact('logos'));
});

Route::get('file/{folder}/{filename}', function($folder, $filename) {
    // Attempt to locate the file on the public disk first
    $disk = Storage::disk('public');
    $path = "{$folder}/{$filename}";
    if (! $disk->exists($path)) {
        // Fallback to the private local disk (used for legacy files)
        $disk = Storage::disk('local');
        $path = "private/{$folder}/{$filename}";
        if (! $disk->exists($path)) {
            abort(404);
        }
    }
    $fullPath = $disk->path($path);
    $mimeType = File::mimeType($fullPath);
    return response()->file($fullPath, ['Content-Type' => $mimeType]);
})->name('public.file');

Route::get('/agenda', function (Illuminate\Http\Request $request) {
    $query = \App\Models\Agenda::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('location', 'like', '%' . $request->search . '%');
    }

    if ($request->has('status') && $request->status != '') {
        if ($request->status == 'akan_datang') {
            $query->whereIn('status', ['upcoming', 'ongoing']);
            $query->orderBy('start_date', 'asc');
        } elseif ($request->status == 'selesai') {
            $query->where('status', 'completed');
            $query->orderBy('start_date', 'desc');
        } else {
            $query->where('status', $request->status);
            $query->orderBy('start_date', 'desc');
        }
    } else {
        $query->where('status', '!=', 'cancelled');
        $query->orderBy('start_date', 'desc');
    }

    $agendas = $query->paginate(10)->withQueryString();
    
    // Top 3 popular agendas by clicks
    $popularAgendas = \App\Models\Agenda::where('clicks_count', '>', 0)
                                        ->orderBy('clicks_count', 'desc')
                                        ->take(3)
                                        ->get();
                                        
    return view('agenda', compact('agendas', 'popularAgendas'));
});

Route::get('/agenda/{id}/click', function ($id) {
    $agenda = \App\Models\Agenda::findOrFail($id);
    $agenda->increment('clicks_count');
    
    if (request('type') == 'daftar' && $agenda->link_url) {
        return redirect()->away($agenda->link_url);
    } elseif (request('type') == 'materi' && $agenda->attachment_path) {
        // Since attachment_path could be an internal relative path or full URL, handle properly:
        $url = $agenda->attachment_path;
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = url($url);
        }
        return redirect()->away($url);
    }
    
    return back();
})->name('agenda.click');

Route::get('/regulasi', function (Illuminate\Http\Request $request) {
    $query = \App\Models\Document::whereHas('category', function($q) {
        $q->where('name', 'like', '%Regulasi%')
          ->orWhere('name', 'like', '%Hukum%')
          ->orWhere('name', 'like', '%Peraturan%');
    })->where('access_type', 'public');

    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }



    if ($request->has('year') && $request->year != '') {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->year . '%')
              ->orWhere('description', 'like', '%' . $request->year . '%');
        });
    }

    $documents = $query->latest()->paginate(10)->withQueryString();
    return view('regulasi', compact('documents'));
});

Route::get('/berita', function (Illuminate\Http\Request $request) {
    $query = \App\Models\Post::latestPublished();

    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->has('category') && $request->category != '') {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', $request->category)->orWhere('id', $request->category);
        });
    }

    $posts = $query->paginate(10)->withQueryString();
    $categories = \App\Models\Category::where('type', 'post')->get();
    
    return view('berita', compact('posts', 'categories'));
});
Route::get('/berita/{slug}', function ($slug) {
    $post = \App\Models\Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
    
    // Fetch related posts from the same category
    $relatedPosts = \App\Models\Post::where('status', 'published')
        ->where('category_id', $post->category_id)
        ->where('id', '!=', $post->id)
        ->inRandomOrder()
        ->take(3)
        ->get();
    // Fallback: if no related posts, fetch latest 5 posts
    if ($relatedPosts->isEmpty()) {
        $relatedPosts = \App\Models\Post::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }
    return view('berita-detail', compact('post', 'relatedPosts'));
})->name('berita.detail');

// API endpoint for berita search suggestions
Route::get('/api/berita/suggest', function (Illuminate\Http\Request $request) {
    $q = $request->query('q', '');
    $suggestions = \App\Models\Post::where('status', 'published')
        ->where('title', 'like', "%{$q}%")
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get(['id', 'title', 'slug']);
    return response()->json($suggestions);
});



Route::get('/login2026', function () {
    return view('loginAdmin');
});
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('posts/upload-image', [\App\Http\Controllers\Admin\PostController::class, 'uploadImage'])->name('posts.uploadImage');
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('documents', \App\Http\Controllers\Admin\DocumentController::class);
    // Agenda Routes
    Route::resource('agendas', \App\Http\Controllers\Admin\AgendaController::class);

    // Services Routes
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);

    // Venues Routes
    Route::resource('venues', \App\Http\Controllers\Admin\VenueController::class);

    // Connected Apps Routes
    Route::resource('connected_apps', \App\Http\Controllers\Admin\ConnectedAppController::class);

    // Skm Data Routes
    Route::resource('skm_data', \App\Http\Controllers\Admin\SkmDataController::class);

    // Social Media Routes
    Route::resource('social_medias', \App\Http\Controllers\Admin\SocialMediaController::class);

    Route::resource('officials', \App\Http\Controllers\Admin\OfficialController::class);

    // Official Logos
    Route::resource('official_logos', \App\Http\Controllers\Admin\OfficialLogoController::class);

    // Announcements
    Route::resource('announcements', \App\Http\Controllers\Admin\AnnouncementController::class);

    Route::get('files/{folder}/{filename}', [\App\Http\Controllers\Admin\FilePreviewController::class, 'show'])->name('files.preview');
});

require __DIR__ . '/auth.php';
