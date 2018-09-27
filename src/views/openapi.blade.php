{
  "openapi": "3.0.1",
  "info": {
    "title": "Local File Finder REST Web Services",
    "version": "1.0.0",
    "description": "File Finder REST Web Service for Local Files Laravel Package.",
    "contact": {
      "name": "File Finder Package on Github",
      "url": "https://github.com/muharihar/FileFinder"
    },
    "license": {
      "name": "Apache License 2.0",
      "url": "https://github.com/muharihar/FileFinder"
    }
  },
  "servers": [
    {
      "url": "{scheme}://{host}:{port}/{basePath}",
      "description": "Production Server",
      "variables": {
        "scheme": {
          "description": "The API is accessible via https and http",
          "enum": [
            "https",
            "http"
          ],
          "default": "http"
        },
        "host": {
          "descrition": "API IP addresses or Hostname",
          "default": "localhost"
        },
        "port": {
          "descrition": "API PORT",
          "default": "8000"
        },
        "basePath": {
          "description": "Base path",
          "enum": [
            "file-finder/api/v1.0"
          ],
          "default": "file-finder/api/v1.0"
        }
      }
    }
  ],
  "tags": [
    {
      "name": "Search",
      "description": "Search Features"
    },
    {
      "name": "List",
      "description": "Default Features"
    }
  ],
  "paths": {
    "/default/list-dir-and-files": {
      "get": {
        "tags": [
          "List"
        ],
        "summary": "List directories and files",
        "operationId": "listDirAndFiles",
        "responses": {
          "200": {
            "description": "Return",
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/DefaultResponse"
                }
              }
            }
          },
          "default": {
            "description": "Return with error",
            "content": {
              "application/json": {}
            }
          }
        }
      }
    },
    "/search/by-name": {
      "get": {
        "tags": [
          "Search"
        ],
        "summary": "Search by Name",
        "operationId": "searchByName",
        "parameters": [
          {
            "$ref": "#/components/parameters/SearchKeyParam"
          }
        ],
        "responses": {
          "200": {
            "description": "Return",
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/DefaultResponse"
                }
              }
            }
          },
          "default": {
            "description": "Return with error",
            "content": {
              "application/json": {}
            }
          }
        }
      }
    },
    "/search/by-content": {
      "get": {
        "tags": [
          "Search"
        ],
        "summary": "Search by Content",
        "operationId": "searchByContent",
        "parameters": [
          {
            "$ref": "#/components/parameters/SearchKeyByContentParam"
          }
        ],
        "responses": {
          "200": {
            "description": "Return",
            "content": {
              "application/json": {
                "schema": {
                  "$ref": "#/components/schemas/SearchByContentResponse"
                }
              }
            }
          },
          "default": {
            "description": "Return with error",
            "content": {
              "application/json": {}
            }
          }
        }
      }
    }
  },
  "components": {
    "schemas": {
      "DefaultResponse": {
        "type": "object",
        "properties": {
          "searchKey": {
            "type": "string",
            "description": "Search Key Request",
            "example": "obama"
          },
          "results": {
            "type": "array",
            "description": "Search Result Collection",
            "items": {
              "$ref": "#/components/schemas/ResultObject"
            }
          },
          "searchCount": {
            "type": "integer",
            "description": "Search Result Count",
            "example": 1
          }
        }
      },
      "SearchByContentResponse": {
        "type": "object",
        "properties": {
          "searchKey": {
            "type": "string",
            "description": "Search Key Request",
            "example": "obama"
          },
          "results": {
            "type": "array",
            "description": "Search Result Collection",
            "items": {
              "$ref": "#/components/schemas/ResultByContentObject"
            }
          },
          "searchCount": {
            "type": "integer",
            "description": "Search Result Count",
            "example": 1
          }
        }
      },
      "ResultObject": {
        "type": "object",
        "description": "Search Result",
        "properties": {
          "idx": {
            "type": "integer",
            "description": "Index",
            "example": 1
          },
          "isDir": {
            "type": "boolean",
            "description": "Is directory",
            "example": false
          },
          "shortPath": {
            "type": "string",
            "description": "File Short Path (We hide the Fullpath for security reason)",
            "example": "public/file-finder/folder_peoples/folder_presidents/file_us.txt"
          },
          "extension": {
            "type": "string",
            "description": "File Extention",
            "example": "txt"
          },
          "fileSize": {
            "type": "integer",
            "description": "File Size",
            "example": 6713
          },
          "parentPath": {
            "type": "string",
            "description": "Parent path",
            "example": "public/file-finder/folder_peoples/folder_presidents"
          }
        }
      },
      "ResultByContentObject": {
        "type": "object",
        "description": "Search by Content Result",
        "properties": {
          "idx": {
            "type": "integer",
            "description": "Index",
            "example": 1
          },
          "isDir": {
            "type": "boolean",
            "description": "Is directory",
            "example": false
          },
          "shortPath": {
            "type": "string",
            "description": "File Short Path (We hide the Fullpath for security reason)",
            "example": "public/file-finder/folder_peoples/folder_presidents/file_us.txt"
          },
          "extension": {
            "type": "string",
            "description": "File Extention",
            "example": "txt"
          },
          "fileSize": {
            "type": "integer",
            "description": "File Size",
            "example": 6713
          },
          "parentPath": {
            "type": "string",
            "description": "Parent path",
            "example": "public/file-finder/folder_peoples/folder_presidents"
          },
          "info": {
            "type": "object",
            "properties": {
              "firstPos": {
                "type": "integer",
                "description": "First Search Key Position",
                "example": 6580
              },
              "firstStr": {
                "type": "string",
                "description": "Part of Search Result",
                "example": "...Obama,http://en.wikipedia.org/wiki/Barack_Obama,20"
              }
            }
          }
        }
      }
    },
    "parameters": {
      "SearchKeyParam": {
        "in": "query",
        "name": "s",
        "description": "Search Key",
        "required": true,
        "allowEmptyValue": false,
        "schema": {
          "type": "string"
        },
        "example": "folder"
      },
      "SearchKeyByContentParam": {
        "in": "query",
        "name": "s",
        "description": "Search Key",
        "required": true,
        "allowEmptyValue": false,
        "schema": {
          "type": "string"
        },
        "example": "Obama"
      }
    }
  },
  "externalDocs": {
    "description": "Find out more about File Finder Package",
    "url": "https://github.com/muharihar/FileFinder"
  }
}