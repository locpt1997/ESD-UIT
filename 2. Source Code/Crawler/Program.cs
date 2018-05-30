using System;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using System.Windows;

namespace ConsoleApp1
{
    class Program
    {
        static HttpClient httpClient;
        static HttpClientHandler handler;
        static CookieContainer cookie = new CookieContainer();
        static string[] ListMenuLinksCat = new string[22];
        static string[] ListMenuLinksDog = new string[18];

        static void Main(string[] args)
        {
            string uri = "https://petthings.vn/";
            IniHttpClient();
            CrawlLinks(uri);
            
            for (int i = 0; i < ListMenuLinksCat.Length; i++)
            {
                int a = 0;
                CountPageinUrl(uri, ListMenuLinksCat[i], ref a);
                for (int j = 1; j <= a; j++)
                {
                    CrawProduct(uri, ListMenuLinksCat[i], j);
                }
            }
        }
        static void IniHttpClient()
        {
            handler = new HttpClientHandler
            {
                CookieContainer = cookie,
                ClientCertificateOptions = ClientCertificateOption.Automatic,
                AutomaticDecompression = DecompressionMethods.GZip | DecompressionMethods.Deflate,
                AllowAutoRedirect = true,
                UseDefaultCredentials = false
            };

            httpClient = new HttpClient(handler);

            httpClient.BaseAddress = new Uri("https://petthings.vn/");
        }
        static string CrawlDataFromURL(string url)
        {
            string html = "";

            html = httpClient.GetStringAsync(url).Result;

            return html;
        }

        static void CrawlLinks(string url)
        {
            string html = CrawlDataFromURL(url);
            var MenuMainList = Regex.Matches(html, @"(normal sub menu)(.*?)(end normal sub menu)"
, RegexOptions.Singleline);
            int o = 0;
            foreach (var Menu in MenuMainList)
            {
                if (o == 0)
                {
                    var ListLinkCats = Regex.Matches(Menu.ToString(), @"href(.*?)>", RegexOptions.Singleline);
                    o++;
                    int x = 0;
                    foreach (var Menu0 in ListLinkCats)
                    {
                        int i = ListMenuLinksCat.Length;
                        ListMenuLinksCat[x] = Regex.Match(Menu0.ToString(), @"/(.*?)>").Value.Replace("\"", "").Replace(">", "");
                        x++;
                        if (x == i)
                        { break; }
                    }
                }
                else
                {
                    var ListLinkDogs = Regex.Matches(Menu.ToString(), @"href(.*?)>", RegexOptions.Singleline);
                    int x = 0;
                    foreach (var Menu0 in ListLinkDogs)
                    {
                        int i = ListMenuLinksDog.Length;
                        ListMenuLinksDog[x] = Regex.Match(Menu0.ToString(), @"/(.*?)>").Value.Replace("\"", "").Replace(">", "");
                        x++;
                        if (x == i)
                        { break; }
                    }
                }
            }
        }

        static void CountPageinUrl(string url, string link, ref int a)
        {      
            url = string.Concat(url, link);
            string html = CrawlDataFromURL(url);
            var b = Regex.Matches(html, @"pagination_wrapper(.*?)/ul", RegexOptions.Singleline);
            foreach (var p in b)
            {
                var c = Regex.Matches(p.ToString(), @"page=(.*?)>", RegexOptions.Singleline);
                foreach (var dem in c)
                {
                    string d = Regex.Match(dem.ToString(),@"=(.*?)""",RegexOptions.Singleline).Value.Replace("\"", "").Replace("=", "");
                    int e = int.Parse(d);
                    if (e >= a)
                    {
                        a = e;
                    }
                }
            }
        }
        static void CrawProduct(string url, string link, int i)
        {
            string a = string.Concat("?page=",i,"&aelang=vi");
            url = string.Concat(url,link,a);
            string html = CrawlDataFromURL(url);

        }
    }
}
