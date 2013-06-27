using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Web;
using System.Web.Services;
using ConsoleApplication1.simplecrud;

namespace ConsoleApplication1
{
    class Program
    {
        static void Main(string[] args)
        {
            simplecrud.simpleService ws = new simplecrud.simpleService();
            //string mensaje = ws.conexionMysqlcreate("roberto","33333","localhost","megaz","m@m.com");
            //string mensaje = ws.conexionMysqldelete(131);
            //string mensaje = ws.conexionMysqlupdate(131, "desdec#", "1111", "ninguna");
            string mensaje = ws.conexionMysqlread();
            Console.WriteLine(mensaje);
            Console.ReadLine();
        }
    }
}
