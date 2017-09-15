# laravel-haversine

    $results = GenericModel::location($latitude, $longitude, 20)->get();

or
    $results = GenericModel::location($latitude, $longitude, 20)->paginate(10);
