# Test Technical Monoma

## Hexagonal architecture with Laravel

This is a technical test where...

## API Endpoint
1. Generate access token
 
    POST /auth
    {
    "username": "tester",
    "password": "PASSWORD"
    }

   401 Unauthorized
    {
        "meta": { "success":
        false,"errors": [
        "Password incorrect for: tester"
        ]
     }
    }
3. Create candidate
   POST /lead
   {
    "name": "Mi candidato",
    "source": "Fotocasa",
    "owner": 2
    }
   
4. Get Candidate 
    GET /lead/{id}
    
5. Get All Cantidates
    GET /leads

    ## Feacture Extras
    
    JWT for token
    
    PHPUnit for testing
    
    Factories and Seeders
    
    Redi for cache

***The Laravel installation used is through docker with the Sail tool***


## For initialized
    * vendor/bin/sail up -d
## For testing
    * vendor/bin/sail test

***Default configuration `.env.example`***

## License

    The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
    

  
