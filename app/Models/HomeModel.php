<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class HomeModel extends Model
{
    use HasFactory;

    // Method to retrieve all users
    
     // Method to retrieve all users
    public static function get_clients()
    {
       return DB::table('clients')->get()->toArray();
    }

     public static function get_testimonial()
    {
       return DB::table('testimonials')->get()->toArray();
    }
    
     public static function get_blog_latest()
    {
       return DB::table('blog')->where('date', '<=', date('Y-m-d'))->limit(3)->get()->toArray();
    }

    
    public static function get_featured_services()
    {
       return DB::table('services')->where('featured',1)->get()->toArray();
    }

     public static function get_sliders()
    {
       return DB::table('sliders')->get()->toArray();
    }

    public static function get_services()
    {
       return DB::table('services')->get()->toArray();
    }


     public static function get_servicesById($slug)
    {
       return DB::table('services')->where('slug', $slug)->first(); // returns an stdClass
    }


     public static function get_about()
    {
       return DB::table('abouts')->get()->first();
    }


     public static function get_portfolio()
    {
       return DB::table('portfolio')->get()->toArray();
    }


    public static function get_blog()
    {
       return DB::table('blogs')->get()->toArray();
    }

     public static function get_blogById($id)
    {
       return DB::table('blogs')->where('id', $id)->first(); // returns an stdClass
    }


     public static function get_projects_category()
    {
       return DB::table('categories')->get();
    }

     public static function get_projects()
      {
          return DB::table('projects')
              ->leftJoin('categories', 'projects.category_id', '=', 'categories.id')
              ->select('projects.*', 'categories.name as category_name') // Add more category fields if needed
              ->get();
      }



       public static function get_projectById($id)
    {
       return DB::table('projects')->where('id', $id)->first(); // returns an stdClass
    }

    public static function get_featured_projects()
    {
       return DB::table('projects')->leftJoin('categories', 'projects.category_id', '=', 'categories.id')
              ->select('projects.*', 'categories.name as category_name')->where('featured',1)->get()->toArray();
    }

  public static function get_contact()
{
   return DB::table('contacts')->first(); // returns stdClass or null

    
}



    


    
    

}
