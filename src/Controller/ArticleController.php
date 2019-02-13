<?php

namespace App\Controller;
use App\Entity\Article;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Request\ParamFetcherInterface;
use App\Representation\Articles;
use Symfony\Component\Validator\ConstraintViolationList;



class ArticleController extends FOSRestController
{
    
    
    /**
    * @Rest\Post(
    *   path = "/articles",
    *   name = "app_article_create"
    * )
    * @Rest\View(
    *     statusCode = 201,
    *     serializerGroups = {"List"}
    * )
    * @ParamConverter("article", converter="fos_rest.request_body",
    * options={
     *         "validator"={ "groups"="Create" }
     *     }
     * )
    */
    public function createAction(Article $article)
    {
        
        $em = $this->getDoctrine()->getManager();

        $em->persist($article);
        $em->flush();

        return $this->view($article, Response::HTTP_CREATED, ['Location' => $this->generateUrl('app_article_show', ['id' => $article->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
    }
    
    
    /**
    * @Rest\Get(
    *     path = "/articles/{id}",
    *     name = "app_article_show",
    *     requirements = {"id"="\d+"}
    * )
    * @Rest\View(
    *     statusCode = 200
    * )
    */
            public function showAction(Article $article)
            {
                return $article;
            }


           
          /**
     * @Rest\Get("/articles", name="app_article_list")
     * @Rest\QueryParam(
     *     name="keyword",
     *     requirements="[a-zA-Z0-9]",
     *     nullable=true,
     *     description="The keyword to search for."
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="5",
     *     description="Max number of movies per page."
     * )
     * @Rest\QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="1",
     *     description="The pagination offset"
     * )
     * @Rest\View(
     * statusCode = 200
     * 
     * )
     */
    public function listAction(ParamFetcherInterface $paramFetcher)
    {
        $pager = $this->getDoctrine()->getManager()->getRepository('App:Article')->search(
            $paramFetcher->get('keyword'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset')
        );
        /* $yoyo = new Articles($pager);
        dump($yoyo);exit; */
        return new Articles($pager);
 
    }
        }
        