<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* utils/pagination.html.twig */
class __TwigTemplate_1cd6d88872dd56db4bcf1c7ed140bff3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "utils/pagination.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "utils/pagination.html.twig"));

        // line 1
        if (twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 1, $this->source); })()), "hasToPaginate", [], "any", false, false, false, 1)) {
            // line 2
            echo "
    ";
            // line 3
            $context["currentPath"] = $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 3, $this->source); })()), "request", [], "any", false, false, false, 3), "attributes", [], "any", false, false, false, 3), "get", ["_route"], "method", false, false, false, 3), twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 3, $this->source); })()), "request", [], "any", false, false, false, 3), "attributes", [], "any", false, false, false, 3), "get", ["_route_params"], "method", false, false, false, 3));
            // line 4
            echo "
    <ul class=\"pagination justify-content-center\">


        ";
            // line 8
            if (twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 8, $this->source); })()), "hasPreviousPage", [], "any", false, false, false, 8)) {
                // line 9
                echo "            <li class=\"page-item\">
                <a class=\"page-link\" href=\"";
                // line 10
                echo twig_escape_filter($this->env, (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 10, $this->source); })()), "html", null, true);
                echo "?page=";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 10, $this->source); })()), "previousPage", [], "any", false, false, false, 10), "html", null, true);
                echo "\">
                    <span aria-hidden=\"true\">&laquo;</span>
                </a>
            </li>
        ";
            } else {
                // line 15
                echo "
            <li class=\"page-item disabled\">
                <a class=\"page-link\" href=\"#\">
                    <span aria-hidden=\"true\">&laquo;</span>
                </a>
            </li>
        ";
            }
            // line 22
            echo "
        ";
            // line 23
            $context["limit"] = 5;
            // line 24
            echo "        ";
            $context["fromPage"] = (((twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 24, $this->source); })()), "currentPage", [], "any", false, false, false, 24) > (isset($context["limit"]) || array_key_exists("limit", $context) ? $context["limit"] : (function () { throw new RuntimeError('Variable "limit" does not exist.', 24, $this->source); })()))) ? ((twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 24, $this->source); })()), "currentPage", [], "any", false, false, false, 24) - (isset($context["limit"]) || array_key_exists("limit", $context) ? $context["limit"] : (function () { throw new RuntimeError('Variable "limit" does not exist.', 24, $this->source); })()))) : (1));
            // line 25
            echo "        ";
            $context["toPage"] = ((((twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 25, $this->source); })()), "lastPage", [], "any", false, false, false, 25) - twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 25, $this->source); })()), "currentPage", [], "any", false, false, false, 25)) >= (isset($context["limit"]) || array_key_exists("limit", $context) ? $context["limit"] : (function () { throw new RuntimeError('Variable "limit" does not exist.', 25, $this->source); })()))) ? ((twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 25, $this->source); })()), "currentPage", [], "any", false, false, false, 25) + (isset($context["limit"]) || array_key_exists("limit", $context) ? $context["limit"] : (function () { throw new RuntimeError('Variable "limit" does not exist.', 25, $this->source); })()))) : (twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 25, $this->source); })()), "lastPage", [], "any", false, false, false, 25)));
            // line 26
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range((isset($context["fromPage"]) || array_key_exists("fromPage", $context) ? $context["fromPage"] : (function () { throw new RuntimeError('Variable "fromPage" does not exist.', 26, $this->source); })()), (isset($context["toPage"]) || array_key_exists("toPage", $context) ? $context["toPage"] : (function () { throw new RuntimeError('Variable "toPage" does not exist.', 26, $this->source); })())));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 27
                echo "            ";
                if (($context["i"] == twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 27, $this->source); })()), "currentPage", [], "any", false, false, false, 27))) {
                    // line 28
                    echo "                <li class=\"page-item active\">
                    <a class=\"page-link\" href=\"#\">";
                    // line 29
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "</a>
                </li>
            ";
                } else {
                    // line 32
                    echo "                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"";
                    // line 33
                    echo twig_escape_filter($this->env, (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 33, $this->source); })()), "html", null, true);
                    echo "?page=";
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "\">
                        ";
                    // line 34
                    echo twig_escape_filter($this->env, $context["i"], "html", null, true);
                    echo "
                    </a>
                </li>
            ";
                }
                // line 38
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            echo "
        ";
            // line 40
            if (twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 40, $this->source); })()), "hasNextPage", [], "any", false, false, false, 40)) {
                // line 41
                echo "            <li class=\"page-item\">
                <a class=\"page-link\" href=\"";
                // line 42
                echo twig_escape_filter($this->env, (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 42, $this->source); })()), "html", null, true);
                echo "?page=";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["p"]) || array_key_exists("p", $context) ? $context["p"] : (function () { throw new RuntimeError('Variable "p" does not exist.', 42, $this->source); })()), "nextPage", [], "any", false, false, false, 42), "html", null, true);
                echo "\">
                    <span aria-hidden=\"true\">&raquo;</span>
                </a>
            </li>
        ";
            } else {
                // line 47
                echo "            <li class=\"page-item disabled\">
                <a class=\"page-link\" href=\"#\">
                    <span aria-hidden=\"true\">&raquo;</span>
                </a>
            </li>
        ";
            }
            // line 53
            echo "    </ul>

";
        }
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "utils/pagination.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  156 => 53,  148 => 47,  138 => 42,  135 => 41,  133 => 40,  130 => 39,  124 => 38,  117 => 34,  111 => 33,  108 => 32,  102 => 29,  99 => 28,  96 => 27,  91 => 26,  88 => 25,  85 => 24,  83 => 23,  80 => 22,  71 => 15,  61 => 10,  58 => 9,  56 => 8,  50 => 4,  48 => 3,  45 => 2,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% if p.hasToPaginate %}

    {% set currentPath = path(app.request.attributes.get('_route'), app.request.attributes.get('_route_params')) %}

    <ul class=\"pagination justify-content-center\">


        {% if p.hasPreviousPage %}
            <li class=\"page-item\">
                <a class=\"page-link\" href=\"{{ currentPath }}?page={{ p.previousPage }}\">
                    <span aria-hidden=\"true\">&laquo;</span>
                </a>
            </li>
        {% else %}

            <li class=\"page-item disabled\">
                <a class=\"page-link\" href=\"#\">
                    <span aria-hidden=\"true\">&laquo;</span>
                </a>
            </li>
        {% endif %}

        {% set limit = 5 %}
        {% set fromPage = p.currentPage > limit ? p.currentPage - limit : 1 %}
        {% set toPage = p.lastPage - p.currentPage >= limit ? p.currentPage + limit : p.lastPage %}
        {% for i in fromPage..toPage %}
            {% if i == p.currentPage %}
                <li class=\"page-item active\">
                    <a class=\"page-link\" href=\"#\">{{ i }}</a>
                </li>
            {% else %}
                <li class=\"page-item\">
                    <a class=\"page-link\" href=\"{{ currentPath }}?page={{ i }}\">
                        {{ i }}
                    </a>
                </li>
            {% endif %}
        {% endfor %}

        {% if p.hasNextPage %}
            <li class=\"page-item\">
                <a class=\"page-link\" href=\"{{ currentPath }}?page={{ p.nextPage }}\">
                    <span aria-hidden=\"true\">&raquo;</span>
                </a>
            </li>
        {% else %}
            <li class=\"page-item disabled\">
                <a class=\"page-link\" href=\"#\">
                    <span aria-hidden=\"true\">&raquo;</span>
                </a>
            </li>
        {% endif %}
    </ul>

{% endif %}", "utils/pagination.html.twig", "/symfony/templates/utils/pagination.html.twig");
    }
}
