<?php
	namespace App\Http\Controllers;
	use App\Models\Article;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Log;
	class ArticleController extends Controller
	{
		 public function index()
		 {
			 $articles = Article::orderBy('created_at', 'desc')->limit(5)->get();
			 return view('articles.index', compact('articles'));
		 }
		 public function create()
		 {
		 	return view('articles.create');
		 }
		 public function store(Request $request)
		 {
			 $data = $request->validate([
			 'title' => 'required|string|max:255',
			 'content' => 'required|string',
			 'published_at' => 'nullable|date',
			 'autor' => 'nullable|string|max:255'
			 ]);
			 Article::create($data);
			 Log::info('TEST LOG');
			 return redirect()->route('articles.index')->with('success', 'Artículo creado.');
		 }
		 public function show(Article $article)
		 {
		 	return view('articles.show', compact('article'));
		 }
		 public function edit(Article $article)
		 {
		 	return view('articles.edit',  compact('article'));
		 }
		 public function update(Request $request, Article $article)
		 {
			 $data = $request->validate([
			 'title' => 'required|string|max:255',
			 'content' => 'required|string',
			 'published_at' => 'nullable|date',
			 'autor' => 'nullable|string'
			 ]);
			 $article->update($data);
			 return redirect()->route('articles.index')->with('success', 'Artículo actualizado.');
		 }
		 public function destroy(Article $article)
		 {
			 $article->delete();
			 return redirect()->route('articles.index')->with('success', 'Artículo eliminado.');
		 }

		 public function listArticlesAPI(Request $request, Article $article ){

			//Leer el valor del parametro q que viene por GET
			//$info = $_GET["q"];
			$info = $request->query('q');
			///var_dump($info);

			$num = $request->query('num');
			$limit = $request->query('limit');

			//Devuelve un JSON con el listado articulos cuyo titulo /contenido  el texto almacenado en info
			//Select * from articles where title like $info
			if(!empty($info)){
				$articles = Article::query()->where('title', 'like', '%'.$info.'%')->orWhere('content', 'like', '%'.$info.'%')->limit(5)->get();
			}

			if(!empty($num)){
				if(!isset($limit) || $limit == 0){
					$limit = 5;
				}
				$articles = Article::query()->offset($num)->limit($limit)->orderByDesc('created_at')->get();
			}

			return response()->json($articles);

		 }

		 public function listADetaiAlrticleAPI(Request $request, $id ){

			$article = Article::findOrFail($id);

			return response()->json([
				'id'		=>$article->id,
				'title'     => $article->title,
				'body'      => $article->content,
				'autor'     => $article->autor,
				'published' => $article->published_at,
				'created'   => $article->created_at,
			]);

		 }
		 public function deleteArticleAPI(Request $request, $id ){
			console.log("ESTAMOS ENTRANDO");
			$article = Article::findOrFail($id);
			$article->delete();

			return response()->json(['ok' => true], 200);

		}
	}
	
?>	
	
