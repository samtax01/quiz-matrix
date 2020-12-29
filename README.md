
# quiz-matrix

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


## API Documentation

Consist of only one endpoint ```[POST] '/api/matrix'```.  
Below is the parameter requirements and expected return values


Request Payload
```
{
    "first": [
        [4,3],	
        [2,8]
    ],
    "second": [
        [12, 23],
        [5,9]
    ]	
},

```

And Response Payload

```
{
    "status": true,
    "message": "success",
    "data": [
        [
            "BK",
            "DO"
        ],
        [
            "BL",
            "DN"
        ]
    ]
}

```

